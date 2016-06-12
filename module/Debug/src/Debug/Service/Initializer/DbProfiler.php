<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Debug\Service\Initializer;

use Zend\ServiceManager\InitializerInterface;
use Zend\Db\Adapter\Profiler\ProfilerAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;


class DbProfiler implements InitializerInterface
{
    /**
     *
     * @var Zend\Db\Adapter\Profiler\Profiler
     */
    protected $profiler;


    /**
     * Initialize
     * @param Zend\Db\Adapter\Profiler\ProfilerAwareInterface $instance
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function initialize($instance, ServiceLocatorInterface $serviceLocator)
    {
        if ($instance instanceOf ProfilerAwareInterface) {
            $instance->setProfiler($this->getProfiler($serviceLocator));
        }
    }

    /**
     * * Let's grab the profiler the ServiceManager has, if there is no profiler, we will create one.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return type
     */
    public function getProfiler(ServiceLocatorInterface $serviceLocator)
    {
        if (!$this->profiler) {
            if ($serviceLocator->has('database-profiler')) {
                $this->profiler = $serviceLocator->get('database-profiler');
            } else {
                $this->profiler = new Profiler();
                $serviceLocator->setService('database-profiler', $this->profiler);
            }
        }
        return $this->profiler;
    }

}