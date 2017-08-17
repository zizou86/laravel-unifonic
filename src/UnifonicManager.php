<?php

namespace zizou86\Unifonic;


class UnifonicManager
{

    /**
     * @var AppSid
     */
    public $appsid;


    /**
     * UnifonicManager constructor.
     */
    public function __construct()
    {
        $this->with(
            config('unifonic.appsid.default')
        );
    }


    /**
     * Load the custom AppSid interface.
     *
     * @param AppContract $appsid
     * @return $this
     */
    public function withCustomApp(AppContract $appsid)
    {
        $this->appsid = $appsid;
        return $this;
    }



    /**
     * Create new app instance with given credentials.
     *
     * @param string $appsid
     * @param array $urls
     * @return $this
     */
    public function with($appsid = null, array $urls = null)
    {
        $urls = $urls ?: config('unifonic.urls');
        $appsid = $appsid ?: config('unifonic.appsid.default');
        $this->appsid = new App($appsid, $urls);
        return $this;
    }


    /**
     * Dynamically call methods on the app.
     *
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!method_exists($this->appsid, $method)) {
            abort(500, "Method $method does not exist");
        }
        return call_user_func_array([$this->appsid, $method], $parameters);
    }

}