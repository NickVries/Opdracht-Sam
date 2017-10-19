<?php

namespace Nick\Framework\Contracts;

interface ServiceProviderInterface
{
    /**
     * Register app bindings.
     *
     * @return mixed
     */
    public function register();
}
