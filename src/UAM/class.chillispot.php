<?php
namespace UAM;

class Chillispot extends UAM
{
    private $_uam_server = 'http://localhost:8080/login';
    private $_uam_secret = 'password';

    public function __construct($params = []) {
        
    }

    /**
     * try authorize user
     *
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Klein\App $app
     */
    public function login($request, $response, $service, $app) {
        $get_params = $request->paramsGet();
        // copy userurl
        $userurl = $get_params->userurl;
        // remove parameters
        unset($get_params->username,
            $get_params->password,
            $get_params->response,
            $get_params->userurl);
        // set new parameters
        $get_params->set('res', 'success');
        $get_params->set('uamip', 'localhost');
        $get_params->set('uamport', 3990);
        $get_params->set('called', '00-00-00-00-00-00');
        $get_params->set('mac', '00-00-00-00-00-00');
        $get_params->set('nasid', 'nas01');
        $get_params->set('userurl', $userurl);
        $get_params->set('challenge', md5(uniqid(microtime(TRUE))));
        $md = $this->get_md($this->_uam_server .'?'. http_build_query($get_params->all(), '', '&'), $this->_uam_secret);
        $get_params->set('md', $md);
        $response->redirect($this->_uam_server .'?'. http_build_query($get_params->all(), '', '&'));
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
        echo 'logoff';
    }

    /**
     * redirects user to UAM server/URL
     *
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Klein\App $app
     */
    public function prelogin($request, $response, $service, $app) {
        echo 'prelogin';
    }

    /**
     * cancel login and disconnect user
     *
     * @param \Klein\Request $request
     * @param \Klein\Response $response
     * @param \Klein\ServiceProvider $service
     * @param \Klein\App $app
     */
    public function abort($request, $response, $service, $app) {
        echo 'abort';
    }

    private function get_md($url, $secret) {
        return md5($url.$secret);
    }
}
