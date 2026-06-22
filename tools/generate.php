<?php

declare(strict_types=1);

/**
 * Code generator for the Enhance API client.
 *
 * Reads the vendored OpenAPI specification (spec/oas3-api.json) and emits the
 * Enum, DTO, and Resource classes plus the Enhance entry point. Run via:
 *
 *     composer generate
 *
 * The generated files live under src/Enum, src/DTO, and src/Resource and are
 * committed to the repository. Hand-written foundation classes (Client, Http,
 * Base, Contract, Exception, Attribute, and the HttpMethod/HttpStatusCode
 * enums) are never touched by this generator.
 */

namespace GoSuccess\Enhance\Tools;

const NS_ROOT = 'GoSuccess\\Enhance';
const NS_ENUM = NS_ROOT . '\\Enum';
const NS_DTO = NS_ROOT . '\\DTO';
const NS_RESOURCE = NS_ROOT . '\\Resource';
const NS_DTO_ATTRIBUTE = 'GoSuccess\\Enhance\\Attribute\\ArrayItemType';

const RESERVED_ENUMS = ['HttpMethod', 'HttpStatusCode'];

$root = \dirname(__DIR__);
$generator = new Generator($root);
$generator->run();

/**
 * Encapsulates the full generation pipeline.
 */
final class Generator
{
    /** @var array<string, mixed> */
    private array $spec;

    /** @var array<string, array<string, mixed>> */
    private array $schemas;

    /** @var array<string, array<string, mixed>> */
    private array $parameters;

    /**
     * Classification of every component schema: enum | dto | array | scalar | map.
     *
     * @var array<string, string>
     */
    private array $kinds = [];

    private int $enumCount = 0;

    private int $dtoCount = 0;

    private int $resourceCount = 0;

    private int $methodCount = 0;

    public function __construct(private readonly string $root)
    {
        $json = file_get_contents($root . '/spec/oas3-api.json');

        if ($json === false) {
            throw new \RuntimeException('Unable to read spec/oas3-api.json');
        }

        /** @var array<string, mixed> $spec */
        $spec = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        $this->spec = $spec;
        $this->schemas = $spec['components']['schemas'] ?? [];
        $this->parameters = $spec['components']['parameters'] ?? [];
    }

    public function run(): void
    {
        $this->classify();
        $this->clean();
        $this->generateEnums();
        $this->generateDtos();
        $resources = $this->generateResources();
        $this->generateEntryPoint($resources);

        printf(
            "Generated %d enums, %d DTOs, %d resources, %d methods.\n",
            $this->enumCount,
            $this->dtoCount,
            $this->resourceCount,
            $this->methodCount,
        );
    }

    // ---------------------------------------------------------------------
    // Classification
    // ---------------------------------------------------------------------

    private function classify(): void
    {
        foreach ($this->schemas as $name => $schema) {
            $this->kinds[$name] = $this->classifySchema($schema);
        }
    }

    /**
     * @param array<string, mixed> $schema
     */
    private function classifySchema(array $schema): string
    {
        if (isset($schema['enum'])) {
            return 'enum';
        }

        if (isset($schema['allOf'])) {
            return 'dto';
        }

        $type = $schema['type'] ?? null;

        if ($type === 'array') {
            return 'array';
        }

        if (isset($schema['properties']) && $schema['properties'] !== []) {
            return 'dto';
        }

        if ($type === 'object' || isset($schema['additionalProperties'])) {
            return 'map';
        }

        if (\in_array($type, ['string', 'integer', 'number', 'boolean', 'int'], true)) {
            return 'scalar';
        }

        return 'map';
    }

    // ---------------------------------------------------------------------
    // Enums
    // ---------------------------------------------------------------------

    private function generateEnums(): void
    {
        foreach ($this->schemas as $name => $schema) {
            if ($this->kinds[$name] !== 'enum') {
                continue;
            }

            if (\in_array($name, RESERVED_ENUMS, true)) {
                continue;
            }

            $class = $this->className($name);
            $this->writeFile('src/Enum/' . $class . '.php', $this->renderEnum($class, $schema));
            $this->enumCount++;
        }
    }

    /**
     * @param array<string, mixed> $schema
     */
    private function renderEnum(string $name, array $schema): string
    {
        $backing = ($schema['type'] ?? 'string') === 'integer' ? 'int' : 'string';
        $values = $schema['enum'];

        $cases = [];
        $seen = [];

        foreach ($values as $value) {
            $caseName = $this->enumCaseName((string)$value);
            $base = $caseName;
            $i = 2;

            while (isset($seen[$caseName])) {
                $caseName = $base . $i++;
            }

            $seen[$caseName] = true;
            $literal = $backing === 'int' ? (string)(int)$value : "'" . $this->escape((string)$value) . "'";
            $cases[] = "    case {$caseName} = {$literal};";
        }

        $doc = $this->classDoc($schema['description'] ?? ("The {$name} enumeration."));
        $body = implode("\n\n", $cases);

        return <<<PHP
            <?php

            declare(strict_types=1);

            namespace GoSuccess\\Enhance\\Enum;

            {$doc}
            enum {$name}: {$backing}
            {
            {$body}
            }

            PHP;
    }

    private function enumCaseName(string $value): string
    {
        $parts = preg_split('/[^a-zA-Z0-9]+/', $value, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $name = '';

        foreach ($parts as $part) {
            $name .= ucfirst($part);
        }

        if ($name === '') {
            $name = 'Value';
        }

        if (ctype_digit($name[0])) {
            $name = 'V' . $name;
        }

        return $name;
    }

    // ---------------------------------------------------------------------
    // DTOs
    // ---------------------------------------------------------------------

    private function generateDtos(): void
    {
        foreach ($this->schemas as $name => $schema) {
            if ($this->kinds[$name] !== 'dto') {
                continue;
            }

            $class = $this->className($name);
            $this->writeFile('src/DTO/' . $class . '.php', $this->renderDto($class, $schema));
            $this->dtoCount++;
        }
    }

    /**
     * @param array<string, mixed> $schema
     */
    private function renderDto(string $name, array $schema): string
    {
        $merged = $this->mergeSchema($schema);
        $properties = $merged['properties'] ?? [];

        $imports = [];
        $lines = [];

        foreach ($properties as $propName => $propSchema) {
            $php = $this->propertyName($propName);
            $type = $this->resolveType($propSchema);

            foreach ($type['imports'] as $import) {
                $imports[$import] = true;
            }

            $docLines = [];
            $description = $this->oneLine($propSchema['description'] ?? '');

            if ($description !== '') {
                $docLines[] = $description;
            }

            if ($type['docType'] !== null) {
                $docLines[] = '@var ' . $type['docType'];
            }

            if ($docLines !== []) {
                $lines[] = $this->propertyDoc($docLines);
            }

            if ($type['attribute'] !== null) {
                $lines[] = '    ' . $type['attribute'];
            }

            $lines[] = "    public {$type['php']} \${$php} = null;";
            $lines[] = '';
        }

        if ($lines !== []) {
            array_pop($lines);
        }

        $useBlock = $this->useBlock($imports, NS_DTO);
        $doc = $this->classDoc($schema['description'] ?? ("DTO for the {$name} schema."));
        $body = implode("\n", $lines);

        $separator = $useBlock === '' ? '' : "\n";

        return <<<PHP
            <?php

            declare(strict_types=1);

            namespace GoSuccess\\Enhance\\DTO;

            use GoSuccess\\Enhance\\Base\\AbstractDto;
            {$useBlock}{$separator}{$doc}
            class {$name} extends AbstractDto
            {
            {$body}
            }

            PHP;
    }

    // ---------------------------------------------------------------------
    // Resources
    // ---------------------------------------------------------------------

    /**
     * @return array<string, string> Map of accessor property => resource class name
     */
    private function generateResources(): array
    {
        $byTag = [];

        foreach ($this->spec['paths'] as $path => $item) {
            $pathParams = $item['parameters'] ?? [];

            foreach (['get', 'post', 'put', 'patch', 'delete'] as $method) {
                if (! isset($item[$method])) {
                    continue;
                }

                $op = $item[$method];
                $tags = $op['tags'] ?? [];
                // Group by the most specific (last) tag so granular sections such as
                // "plans", "ssl", or "ftp" become their own resources instead of being
                // absorbed into a broad parent tag like "orgs" or "websites".
                $tag = $tags === [] ? 'general' : end($tags);
                $byTag[$tag][] = ['path' => $path, 'method' => $method, 'op' => $op, 'pathParams' => $pathParams];
            }
        }

        ksort($byTag);
        $accessors = [];

        foreach ($byTag as $tag => $operations) {
            $class = $this->pascal($tag) . 'Resource';
            $accessor = $this->camel($tag);
            $accessors[$accessor] = $class;

            $this->writeFile('src/Resource/' . $class . '.php', $this->renderResource($class, $tag, $operations));
            $this->resourceCount++;
        }

        return $accessors;
    }

    /**
     * @param list<array{path: string, method: string, op: array<string, mixed>, pathParams: list<array<string, mixed>>}> $operations
     */
    private function renderResource(string $class, string $tag, array $operations): string
    {
        $imports = [];
        $methods = [];

        foreach ($operations as $operation) {
            $methods[] = $this->renderMethod($operation, $imports);
            $this->methodCount++;
        }

        $useBlock = $this->useBlock($imports, NS_RESOURCE);
        $separator = $useBlock === '' ? '' : "\n";
        $doc = $this->classDoc("Operations for the \"{$tag}\" section of the Enhance API.");
        $body = implode("\n\n", $methods);

        return <<<PHP
            <?php

            declare(strict_types=1);

            namespace GoSuccess\\Enhance\\Resource;

            use GoSuccess\\Enhance\\Base\\AbstractResource;
            use GoSuccess\\Enhance\\Enum\\HttpMethod;
            {$useBlock}{$separator}{$doc}
            final class {$class} extends AbstractResource
            {
            {$body}
            }

            PHP;
    }

    /**
     * @param array{path: string, method: string, op: array<string, mixed>, pathParams: list<array<string, mixed>>} $operation
     * @param array<string, bool> $imports
     */
    private function renderMethod(array $operation, array &$imports): string
    {
        $path = $operation['path'];
        $op = $operation['op'];
        $httpMethod = strtoupper($operation['method']);
        $methodName = $op['operationId'];

        // Resolve parameters.
        $allParams = array_merge($operation['pathParams'], $op['parameters'] ?? []);
        $pathTokens = [];
        preg_match_all('/\{([^}]+)\}/', $path, $matches);

        foreach ($matches[1] as $token) {
            $pathTokens[] = $token;
        }

        $pathParamDefs = [];
        $queryParamDefs = [];

        foreach ($allParams as $param) {
            $param = $this->resolveParam($param);
            $in = $param['in'] ?? null;

            if ($in === 'path') {
                $pathParamDefs[$param['name']] = $param;
            } elseif ($in === 'query') {
                $queryParamDefs[$param['name']] = $param;
            }
        }

        $hasOrg = \in_array('org_id', $pathTokens, true);

        // Build signature parameter groups.
        $required = [];
        $optional = [];
        $endpointReplacements = [];
        $docParams = [];

        foreach ($pathTokens as $token) {
            if ($token === 'org_id') {
                $endpointReplacements['{' . $token . '}'] = '{$orgId}';

                continue;
            }

            $def = $pathParamDefs[$token] ?? ['name' => $token, 'schema' => ['type' => 'string']];
            $type = $this->resolveType($def['schema'] ?? ['type' => 'string'], false);

            foreach ($type['imports'] as $import) {
                $imports[$import] = true;
            }

            $var = $this->camel($token);
            $required[] = "{$type['phpBare']} \${$var}";
            $docParams[] = "@param {$type['docBare']} \${$var} " . $this->oneLine($def['description'] ?? '');
            $endpointReplacements['{' . $token . '}'] = $type['isEnum'] ? '{$' . $var . '->value}' : '{$' . $var . '}';
        }

        // Request body.
        $bodyExpr = 'null';
        $contentType = 'null';
        $body = $this->resolveBody($op);

        if ($body !== null) {
            foreach ($body['imports'] as $import) {
                $imports[$import] = true;
            }

            $param = "{$body['php']} \${$body['var']}";

            if ($body['required']) {
                $required[] = $param;
            } else {
                $optional[] = $param . ' = null';
            }

            $bodyExpr = '$' . $body['var'];
            $contentType = $body['contentType'];
            $docParams[] = "@param {$body['docType']} \${$body['var']} " . $this->oneLine($body['description']);
        }

        // Query parameters.
        $queryEntries = [];

        foreach ($queryParamDefs as $qname => $def) {
            $type = $this->resolveType($def['schema'] ?? ['type' => 'string'], false);

            foreach ($type['imports'] as $import) {
                $imports[$import] = true;
            }

            $var = $this->camel($qname);
            $optional[] = "{$type['phpBare']} \${$var} = null";
            $queryEntries[] = "'{$qname}' => \${$var},";
            $docParams[] = "@param {$type['docBare']}|null \${$var} " . $this->oneLine($def['description'] ?? '');
        }

        if ($hasOrg) {
            $optional[] = '?string $orgId = null';
            $docParams[] = '@param string|null $orgId Organization id (defaults to the configured organization)';
        }

        // Return type.
        $return = $this->resolveReturn($op);

        foreach ($return['imports'] as $import) {
            $imports[$import] = true;
        }

        // Assemble method body.
        $endpoint = strtr($path, $endpointReplacements);
        $statements = [];

        if ($hasOrg) {
            $statements[] = '        $orgId = $this->orgId($orgId);';
        }

        $queryArg = '';

        if ($queryEntries !== []) {
            $queryLines = implode("\n", array_map(static fn (string $entry): string => '            ' . $entry, $queryEntries));
            $statements[] = "        \$query = [\n{$queryLines}\n        ];";
            $queryArg = '$query';
        }

        $requestArgs = ["HttpMethod::{$httpMethod}", "\"{$endpoint}\""];

        if ($queryArg !== '' || $bodyExpr !== 'null' || $contentType !== 'null') {
            $requestArgs[] = $queryArg !== '' ? $queryArg : '[]';
        }

        if ($bodyExpr !== 'null' || $contentType !== 'null') {
            $requestArgs[] = $bodyExpr;
        }

        if ($contentType !== 'null') {
            $requestArgs[] = $contentType;
        }

        $statements[] = '        $response = $this->client->request(' . implode(', ', $requestArgs) . ');';
        $statements[] = '';
        $statements[] = $return['code'];

        $signatureParams = array_merge($required, $optional);
        $signature = $this->formatSignature($methodName, $signatureParams, $return['type']);

        $doc = $this->methodDoc($op, $docParams, $return['docReturn'], $path, $operation['method']);

        return $doc . "\n" . $signature . "\n    {\n" . implode("\n", $statements) . "\n    }";
    }

    // ---------------------------------------------------------------------
    // Entry point
    // ---------------------------------------------------------------------

    /**
     * @param array<string, string> $accessors
     */
    private function generateEntryPoint(array $accessors): void
    {
        $uses = [];
        $properties = [];
        $assignments = [];

        foreach ($accessors as $accessor => $class) {
            $uses[] = "use GoSuccess\\Enhance\\Resource\\{$class};";
            $properties[] = "    public readonly {$class} \${$accessor};";
            $assignments[] = "        \$this->{$accessor} = new {$class}(\$this->client, \$this->config);";
        }

        $uses = implode("\n", $uses);
        $properties = implode("\n\n", $properties);
        $assignments = implode("\n", $assignments);

        $content = <<<PHP
            <?php

            declare(strict_types=1);

            namespace GoSuccess\\Enhance;

            use GoSuccess\\Enhance\\Client\\ApiClient;
            use GoSuccess\\Enhance\\Client\\Configuration;
            use GoSuccess\\Enhance\\Contract\\HttpClientInterface;
            {$uses}

            /**
             * Entry point for the Enhance API client.
             *
             * Exposes one resource per API section. Each resource groups the
             * operations of the corresponding OpenAPI tag.
             *
             * @example
             * ```php
             * \$enhance = Enhance::create('https://cp.example.com/api', 'org-uuid', 'access-token');
             * \$plans = \$enhance->plans->getOrgPlans();
             * ```
             */
            final class Enhance
            {
                public readonly Configuration \$config;

                private readonly HttpClientInterface \$client;

            {$properties}

                public function __construct(Configuration \$config, ?HttpClientInterface \$client = null)
                {
                    \$this->config = \$config;
                    \$this->client = \$client ?? new ApiClient(\$config);

            {$assignments}
                }

                /**
                 * Convenience factory for the common case.
                 */
                public static function create(string \$host, string \$orgId, string \$accessToken): self
                {
                    return new self(new Configuration(\$host, \$orgId, \$accessToken));
                }
            }

            PHP;

        $this->writeFile('src/Enhance.php', $content);
    }

    // ---------------------------------------------------------------------
    // Type resolution
    // ---------------------------------------------------------------------

    /**
     * Resolve a schema into PHP type information.
     *
     * @param array<string, mixed> $schema
     * @return array{php: string, phpBare: string, docType: string|null, docBare: string, attribute: string|null, imports: list<string>, isEnum: bool}
     */
    private function resolveType(array $schema, bool $forProperty = true): array
    {
        $imports = [];

        // Reference to another component.
        if (isset($schema['$ref'])) {
            $target = $this->refName($schema['$ref']);
            $kind = $this->kinds[$target] ?? 'map';

            if ($kind === 'enum') {
                $class = $this->className($target);
                $imports[] = NS_ENUM . '\\' . $class;

                return $this->typeResult($class, null, null, $imports, true);
            }

            if ($kind === 'dto') {
                $class = $this->className($target);
                $imports[] = NS_DTO . '\\' . $class;

                return $this->typeResult($class, null, null, $imports, false);
            }

            if ($kind === 'array') {
                return $this->resolveType($this->schemas[$target], $forProperty);
            }

            if ($kind === 'scalar') {
                return $this->resolveType($this->schemas[$target], $forProperty);
            }

            return $this->typeResult('array', 'array<string, mixed>', null, [], false);
        }

        $type = $schema['type'] ?? null;

        if ($type === 'array') {
            return $this->resolveArrayType($schema['items'] ?? [], $forProperty);
        }

        return match ($type) {
            'string' => isset($schema['format']) && \in_array($schema['format'], ['date-time', 'datetime', 'date'], true) && $forProperty
                ? $this->typeResult('\\DateTimeImmutable', null, null, [], false)
                : $this->typeResult('string', null, null, [], false),
            'integer', 'int' => $this->typeResult('int', null, null, [], false),
            'number' => $this->typeResult('float', null, null, [], false),
            'boolean' => $this->typeResult('bool', null, null, [], false),
            'object' => $this->typeResult('array', 'array<string, mixed>', null, [], false),
            default => $this->typeResult('mixed', null, null, [], false),
        };
    }

    /**
     * @param array<string, mixed> $items
     * @return array{php: string, phpBare: string, docType: string|null, docBare: string, attribute: string|null, imports: list<string>, isEnum: bool}
     */
    private function resolveArrayType(array $items, bool $forProperty): array
    {
        $imports = [];
        $attribute = null;
        $docType = 'array<int, mixed>';

        if (isset($items['$ref'])) {
            $target = $this->refName($items['$ref']);
            $kind = $this->kinds[$target] ?? 'map';

            $class = $this->className($target);

            if ($kind === 'enum') {
                $attribute = "#[ArrayItemType('enum', \\" . NS_ENUM . '\\' . $class . '::class)]';
                $docType = 'array<int, \\' . NS_ENUM . '\\' . $class . '>';
                $imports[] = NS_DTO_ATTRIBUTE;
            } elseif ($kind === 'dto') {
                $attribute = "#[ArrayItemType('dto', \\" . NS_DTO . '\\' . $class . '::class)]';
                $docType = 'array<int, \\' . NS_DTO . '\\' . $class . '>';
                $imports[] = NS_DTO_ATTRIBUTE;
            }
        } elseif (isset($items['type']) && \in_array($items['type'], ['string', 'integer', 'number', 'boolean'], true)) {
            $map = ['string' => 'string', 'integer' => 'int', 'number' => 'float', 'boolean' => 'bool'];
            $scalar = $map[$items['type']];
            $attribute = "#[ArrayItemType('{$scalar}')]";
            $docType = $scalar . '[]';
            $imports[] = NS_DTO_ATTRIBUTE;
        }

        if (! $forProperty) {
            $attribute = null;
            $imports = [];
        }

        return [
            'php' => '?array',
            'phpBare' => '?array',
            'docType' => $docType,
            'docBare' => $docType,
            'attribute' => $attribute,
            'imports' => $imports,
            'isEnum' => false,
        ];
    }

    /**
     * @param list<string> $imports
     * @return array{php: string, phpBare: string, docType: string|null, docBare: string, attribute: string|null, imports: list<string>, isEnum: bool}
     */
    private function typeResult(string $type, ?string $docType, ?string $attribute, array $imports, bool $isEnum): array
    {
        $nullablePhp = str_starts_with($type, '?') || $type === 'mixed' ? $type : '?' . $type;

        return [
            'php' => $nullablePhp,
            'phpBare' => $nullablePhp,
            'docType' => $docType,
            'docBare' => $type === 'mixed' ? 'mixed' : ltrim($type, '?'),
            'attribute' => $attribute,
            'imports' => $imports,
            'isEnum' => $isEnum,
        ];
    }

    /**
     * Resolve the request body of an operation.
     *
     * @param array<string, mixed> $op
     * @return array{php: string, var: string, required: bool, contentType: string, docType: string, description: string, imports: list<string>}|null
     */
    private function resolveBody(array $op): ?array
    {
        if (! isset($op['requestBody']['content'])) {
            return null;
        }

        $content = $op['requestBody']['content'];
        $required = (bool)($op['requestBody']['required'] ?? false);
        $description = $this->oneLine($op['requestBody']['description'] ?? '');

        if (isset($content['multipart/form-data'])) {
            return [
                'php' => 'array', 'var' => 'formData', 'required' => $required,
                'contentType' => "'multipart/form-data'", 'docType' => 'array<string, mixed>',
                'description' => $description !== '' ? $description : 'Multipart form fields.', 'imports' => [],
            ];
        }

        if (isset($content['application/gzip'])) {
            return [
                'php' => 'string', 'var' => 'contents', 'required' => $required,
                'contentType' => "'application/gzip'", 'docType' => 'string',
                'description' => $description !== '' ? $description : 'Raw gzip payload.', 'imports' => [],
            ];
        }

        $schema = $content['application/json']['schema'] ?? [];

        if (isset($schema['$ref'])) {
            $target = $this->refName($schema['$ref']);
            $kind = $this->kinds[$target] ?? 'map';

            $class = $this->className($target);

            if ($kind === 'dto') {
                return [
                    'php' => ($required ? '' : '?') . $class, 'var' => $this->camel($class), 'required' => $required,
                    'contentType' => 'null', 'docType' => $class, 'description' => $description,
                    'imports' => [NS_DTO . '\\' . $class],
                ];
            }

            if ($kind === 'enum') {
                return [
                    'php' => ($required ? '' : '?') . $class, 'var' => 'value', 'required' => $required,
                    'contentType' => 'null', 'docType' => $class, 'description' => $description,
                    'imports' => [NS_ENUM . '\\' . $class],
                ];
            }

            if ($kind === 'array') {
                return [
                    'php' => '?array', 'var' => 'items', 'required' => $required,
                    'contentType' => 'null', 'docType' => 'array<int, mixed>', 'description' => $description, 'imports' => [],
                ];
            }
        }

        $type = $schema['type'] ?? null;

        return match ($type) {
            'string' => ['php' => '?string', 'var' => 'value', 'required' => $required, 'contentType' => 'null', 'docType' => 'string', 'description' => $description, 'imports' => []],
            'integer', 'int' => ['php' => '?int', 'var' => 'value', 'required' => $required, 'contentType' => 'null', 'docType' => 'int', 'description' => $description, 'imports' => []],
            'number' => ['php' => '?float', 'var' => 'value', 'required' => $required, 'contentType' => 'null', 'docType' => 'float', 'description' => $description, 'imports' => []],
            'boolean' => ['php' => '?bool', 'var' => 'value', 'required' => $required, 'contentType' => 'null', 'docType' => 'bool', 'description' => $description, 'imports' => []],
            'array' => ['php' => '?array', 'var' => 'items', 'required' => $required, 'contentType' => 'null', 'docType' => 'array<int, mixed>', 'description' => $description, 'imports' => []],
            default => ['php' => 'mixed', 'var' => 'body', 'required' => $required, 'contentType' => 'null', 'docType' => 'mixed', 'description' => $description, 'imports' => []],
        };
    }

    /**
     * Resolve the success response of an operation into a return type and hydration code.
     *
     * @param array<string, mixed> $op
     * @return array{type: string, code: string, docReturn: string, imports: list<string>}
     */
    private function resolveReturn(array $op): array
    {
        $responses = $op['responses'] ?? [];
        $code = null;

        foreach (['200', '201', '202', '206', '302', '204'] as $candidate) {
            if (isset($responses[$candidate])) {
                $code = $candidate;

                break;
            }
        }

        if ($code === null || ! isset($responses[$code]['content'])) {
            return ['type' => 'bool', 'code' => '        return $response->isSuccess;', 'docReturn' => 'bool True on success', 'imports' => []];
        }

        $content = $responses[$code]['content'];

        if (isset($content['application/gzip'])) {
            return ['type' => 'string', 'code' => '        return $response->rawBody;', 'docReturn' => 'string Raw response body', 'imports' => []];
        }

        $schema = $content['application/json']['schema'] ?? ($content[array_key_first($content)]['schema'] ?? []);

        return $this->returnForSchema($schema);
    }

    /**
     * @param array<string, mixed> $schema
     * @return array{type: string, code: string, docReturn: string, imports: list<string>}
     */
    private function returnForSchema(array $schema): array
    {
        if (isset($schema['$ref'])) {
            $target = $this->refName($schema['$ref']);
            $kind = $this->kinds[$target] ?? 'map';

            $class = $this->className($target);

            if ($kind === 'dto') {
                return [
                    'type' => '?' . $class,
                    'code' => "        return \$response->decoded !== null ? {$class}::fromArray(\$response->decoded) : null;",
                    'docReturn' => $class . '|null',
                    'imports' => [NS_DTO . '\\' . $class],
                ];
            }

            if ($kind === 'enum') {
                return [
                    'type' => '?' . $class,
                    'code' => "        return \\is_string(\$response->decoded) || \\is_int(\$response->decoded) ? {$class}::tryFrom(\$response->decoded) : null;",
                    'docReturn' => $class . '|null',
                    'imports' => [NS_ENUM . '\\' . $class],
                ];
            }

            if ($kind === 'array') {
                return $this->returnForSchema($this->schemas[$target]);
            }

            if ($kind === 'scalar') {
                return $this->returnForSchema($this->schemas[$target]);
            }

            return ['type' => 'mixed', 'code' => '        return $response->decoded;', 'docReturn' => 'mixed', 'imports' => []];
        }

        $type = $schema['type'] ?? null;

        if ($type === 'array') {
            return $this->returnForArray($schema['items'] ?? []);
        }

        return match ($type) {
            'string' => ['type' => '?string', 'code' => '        return $response->decoded === null ? null : (string) $response->decoded;', 'docReturn' => 'string|null', 'imports' => []],
            'integer', 'int' => ['type' => '?int', 'code' => '        return $response->decoded === null ? null : (int) $response->decoded;', 'docReturn' => 'int|null', 'imports' => []],
            'number' => ['type' => '?float', 'code' => '        return $response->decoded === null ? null : (float) $response->decoded;', 'docReturn' => 'float|null', 'imports' => []],
            'boolean' => ['type' => '?bool', 'code' => '        return $response->decoded === null ? null : (bool) $response->decoded;', 'docReturn' => 'bool|null', 'imports' => []],
            default => ['type' => 'mixed', 'code' => '        return $response->decoded;', 'docReturn' => 'mixed', 'imports' => []],
        };
    }

    /**
     * @param array<string, mixed> $items
     * @return array{type: string, code: string, docReturn: string, imports: list<string>}
     */
    private function returnForArray(array $items): array
    {
        if (isset($items['$ref'])) {
            $target = $this->refName($items['$ref']);
            $kind = $this->kinds[$target] ?? 'map';

            $class = $this->className($target);

            if ($kind === 'dto') {
                return [
                    'type' => 'array',
                    'code' => "        return array_map(static fn (array \$item): {$class} => {$class}::fromArray(\$item), (array) (\$response->decoded ?? []));",
                    'docReturn' => $class . '[]',
                    'imports' => [NS_DTO . '\\' . $class],
                ];
            }

            if ($kind === 'enum') {
                return [
                    'type' => 'array',
                    'code' => "        return array_values(array_filter(array_map(static fn (\$item): ?{$class} => {$class}::tryFrom(\$item), (array) (\$response->decoded ?? []))));",
                    'docReturn' => $class . '[]',
                    'imports' => [NS_ENUM . '\\' . $class],
                ];
            }
        }

        return ['type' => 'array', 'code' => '        return (array) ($response->decoded ?? []);', 'docReturn' => 'array<int, mixed>', 'imports' => []];
    }

    // ---------------------------------------------------------------------
    // Schema helpers
    // ---------------------------------------------------------------------

    /**
     * Merge an allOf schema (and referenced sub-schemas) into a single object schema.
     *
     * @param array<string, mixed> $schema
     * @return array<string, mixed>
     */
    private function mergeSchema(array $schema): array
    {
        if (! isset($schema['allOf'])) {
            return $schema;
        }

        $properties = [];

        foreach ($schema['allOf'] as $part) {
            if (isset($part['$ref'])) {
                $part = $this->schemas[$this->refName($part['$ref'])] ?? [];
                $part = $this->mergeSchema($part);
            }

            foreach ($part['properties'] ?? [] as $name => $definition) {
                $properties[$name] = $definition;
            }
        }

        return ['properties' => $properties];
    }

    /**
     * @param array<string, mixed> $param
     * @return array<string, mixed>
     */
    private function resolveParam(array $param): array
    {
        if (isset($param['$ref'])) {
            $name = $this->refName($param['$ref']);

            return $this->parameters[$name] ?? [];
        }

        return $param;
    }

    private function refName(string $ref): string
    {
        $parts = explode('/', $ref);

        return end($parts);
    }

    /**
     * Map a schema name to a valid PHP class identifier, avoiding reserved words.
     */
    private function className(string $schema): string
    {
        static $reserved = [
            'abstract', 'and', 'array', 'as', 'break', 'callable', 'case', 'catch', 'class', 'clone',
            'const', 'continue', 'declare', 'default', 'die', 'do', 'echo', 'else', 'elseif', 'empty',
            'enddeclare', 'endfor', 'endforeach', 'endif', 'endswitch', 'endwhile', 'enum', 'eval', 'exit',
            'extends', 'final', 'finally', 'fn', 'for', 'foreach', 'function', 'global', 'goto', 'if',
            'implements', 'include', 'include_once', 'instanceof', 'insteadof', 'interface', 'isset', 'list',
            'match', 'namespace', 'new', 'or', 'print', 'private', 'protected', 'public', 'readonly', 'require',
            'require_once', 'return', 'static', 'switch', 'throw', 'trait', 'try', 'unset', 'use', 'var',
            'while', 'xor', 'yield', 'int', 'float', 'bool', 'string', 'true', 'false', 'null', 'void',
            'iterable', 'object', 'mixed', 'never', 'self', 'parent',
        ];

        return \in_array(strtolower($schema), $reserved, true) ? $schema . 'Type' : $schema;
    }

    // ---------------------------------------------------------------------
    // Rendering helpers
    // ---------------------------------------------------------------------

    /**
     * @param list<string> $params
     */
    private function formatSignature(string $name, array $params, string $returnType): string
    {
        if ($params === []) {
            return "    public function {$name}(): {$returnType}";
        }

        $oneLine = "    public function {$name}(" . implode(', ', $params) . "): {$returnType}";

        if (\strlen($oneLine) <= 118) {
            return $oneLine;
        }

        $lines = array_map(static fn (string $param): string => '        ' . $param . ',', $params);

        return "    public function {$name}(\n" . implode("\n", $lines) . "\n    ): {$returnType}";
    }

    /**
     * @param array<string, mixed> $op
     * @param list<string> $docParams
     */
    private function methodDoc(array $op, array $docParams, string $docReturn, string $path, string $method): string
    {
        $lines = [];
        $summary = $this->oneLine($op['summary'] ?? '');

        if ($summary !== '') {
            $lines[] = $summary;
        }

        $description = trim((string)($op['description'] ?? ''));

        if ($description !== '' && $description !== ($op['summary'] ?? '')) {
            if ($lines !== []) {
                $lines[] = '';
            }

            foreach (explode("\n", $description) as $line) {
                $lines[] = rtrim($line);
            }
        }

        if ($lines !== []) {
            $lines[] = '';
        }

        $linkTag = ($op['tags'] ?? []) === [] ? 'general' : end($op['tags']);
        $lines[] = \sprintf('@link https://apidocs.enhance.com/#/%s/%s', $linkTag, $op['operationId']);
        $lines[] = \sprintf('%s %s', strtoupper($method), $path);
        $lines[] = '';

        foreach ($docParams as $param) {
            $lines[] = rtrim($param);
        }

        $lines[] = '@throws \\GoSuccess\\Enhance\\Exception\\ApiException';
        $lines[] = '@return ' . $docReturn;

        return $this->renderDoc($lines, '    ');
    }

    /**
     * @param list<string> $lines
     */
    private function renderDoc(array $lines, string $indent): string
    {
        $out = $indent . "/**\n";

        foreach ($lines as $line) {
            $line = str_replace('*/', '* /', $line);
            $out .= $line === '' ? $indent . " *\n" : $indent . ' * ' . $line . "\n";
        }

        return $out . $indent . ' */';
    }

    private function classDoc(string $description): string
    {
        return $this->renderDoc(array_map(rtrim(...), explode("\n", trim($description))), '');
    }

    /**
     * @param list<string> $lines
     */
    private function propertyDoc(array $lines): string
    {
        if (\count($lines) === 1) {
            return '    /** ' . str_replace('*/', '* /', $lines[0]) . ' */';
        }

        return $this->renderDoc($lines, '    ');
    }

    /**
     * @param array<string, bool> $imports
     */
    private function useBlock(array $imports, string $ownNamespace): string
    {
        $statements = [];

        foreach (array_keys($imports) as $fqcn) {
            $namespace = substr($fqcn, 0, (int)strrpos($fqcn, '\\'));

            if ($namespace === $ownNamespace) {
                continue;
            }

            $statements[$fqcn] = "use {$fqcn};";
        }

        if ($statements === []) {
            return '';
        }

        sort($statements);

        return implode("\n", $statements) . "\n";
    }

    private function propertyName(string $name): string
    {
        if (preg_match('/^[a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*$/', $name) === 1) {
            return $name;
        }

        return $this->camel($name);
    }

    private function pascal(string $value): string
    {
        $parts = preg_split('/[^a-zA-Z0-9]+/', $value, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        return implode('', array_map(ucfirst(...), $parts));
    }

    private function camel(string $value): string
    {
        return lcfirst($this->pascal($value));
    }

    private function oneLine(string $value): string
    {
        $value = preg_replace('/\s+/', ' ', trim($value)) ?? '';

        return str_replace('*/', '* /', $value);
    }

    private function escape(string $value): string
    {
        return str_replace(['\\', "'"], ['\\\\', "\\'"], $value);
    }

    // ---------------------------------------------------------------------
    // Filesystem
    // ---------------------------------------------------------------------

    private function clean(): void
    {
        foreach (['src/Enum', 'src/DTO', 'src/Resource'] as $dir) {
            $path = $this->root . '/' . $dir;

            if (! is_dir($path)) {
                continue;
            }

            foreach (glob($path . '/*.php') ?: [] as $file) {
                $base = basename($file, '.php');

                if ($dir === 'src/Enum' && \in_array($base, RESERVED_ENUMS, true)) {
                    continue;
                }

                unlink($file);
            }
        }
    }

    private function writeFile(string $relativePath, string $content): void
    {
        $path = $this->root . '/' . $relativePath;
        $dir = \dirname($path);

        if (! is_dir($dir)) {
            mkdir($dir, 0o755, true);
        }

        file_put_contents($path, $content);
    }
}
