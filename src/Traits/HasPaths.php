<?php

namespace SamWrigley\Support\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasPaths
{
    /**
     * Get full path for given route.
     *
     * @param  string[]  $routeParams  Route parameters
     * @return string Full path
     */
    private function path(array $routeParams): string
    {
        if (!Arr::has($routeParams, ['action', 'key', 'namespace'])) {
            return;
        }

        if (empty($this->namespaces)) {
            return;
        }

        $action = $routeParams['action'];
        $key = $routeParams['key'];
        $namespace = $routeParams['namespace'];

        $routeNamespace = Str::finish($this->namespaces[$namespace], '.');
        $routeName = $routeNamespace.$action;
        $routeParam = [$this->{$key}];

        return route($routeName, $routeParam);
    }

    /**
     * Get the full create path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Create path
     */
    public function createPath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'create',
            'key' => 'id',
            'namespace' => 'admin',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }

    /**
     * Get the full store path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Store path
     */
    public function storePath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'store',
            'key' => 'id',
            'namespace' => 'admin',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }

    /**
     * Get the full show path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Show path
     */
    public function showPath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'show',
            'key' => 'slug',
            'namespace' => 'web',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }

    /**
     * Get the full edit path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Edit path
     */
    public function editPath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'edit',
            'key' => 'id',
            'namespace' => 'admin',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }

    /**
     * Get the full update path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Update path
     */
    public function updatePath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'update',
            'key' => 'id',
            'namespace' => 'admin',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }

    /**
     * Get the full destroy path.
     *
     * @param  array  $routeParams  Route parameters
     * @return string Delete path
     */
    public function destroyPath(array $routeParams = []): string
    {
        $defaultRouteParams = [
            'action' => 'destroy',
            'key' => 'id',
            'namespace' => 'admin',
        ];

        $params = array_merge($defaultRouteParams, $routeParams);

        return $this->path($params);
    }
}
