<?php

namespace SamWrigley\Support\Traits;

trait HasPaths
{
    /**
     * Get full path for given route.
     *
     * @param string[] $routeParams Route parameters
     * @return string Full path
     */
    private function path(array $routeParams)
    {
        if (! array_has($routeParams, ['action', 'key', 'namespace'])) {
            return;
        }

        if (empty($this->namespaces)) {
            return;
        }

        $action = $routeParams['action'];
        $key = $routeParams['key'];
        $namespace = $routeParams['namespace'];

        $routeNamespace = $this->namespaces[$namespace];
        $routeName = $routeNamespace.$action;
        $routeParam = [$this->{$key}];

        return route($routeName, $routeParam);
    }

    /**
     * Get the full create path.
     *
     * @param array $routeParams Route parameters
     * @return string Create path
     */
    public function createPath($routeParams = [])
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
     * @param array $routeParams Route parameters
     * @return string Store path
     */
    public function storePath($routeParams = [])
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
     * @param array $routeParams Route parameters
     * @return string Show path
     */
    public function showPath($routeParams = [])
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
     * @param array $routeParams Route parameters
     * @return string Edit path
     */
    public function editPath($routeParams = [])
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
     * @param array $routeParams Route parameters
     * @return string Update path
     */
    public function updatePath($routeParams = [])
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
     * @param array $routeParams Route parameters
     * @return string Delete path
     */
    public function destroyPath($routeParams = [])
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
