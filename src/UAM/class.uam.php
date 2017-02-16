<?php
namespace UAM;

/**
 * Universal Access Method abstract class
 */
abstract class UAM implements UAMInterface {
    /**
     * try authorise user
     *
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Klein\App $app
     */
    public function login($request, $response, $service, $app) {

    }

    /**
     * send logoff message to AAA and redirects to UAM server/URL
     *
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Klein\App $app
     */
    public function logoff($request, $response, $service, $app) {

    }
}

interface UAMInterface {
    public function login($request, $response, $service, $app);
    public function logoff($request, $response, $service, $app);
}