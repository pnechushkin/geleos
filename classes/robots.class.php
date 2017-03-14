<?php
/**
 * Created by PhpStorm.
 * User: Павел
 * Date: 13.03.2017
 * Time: 15:10
 */
class Robots {
    protected $redirect;
    protected $url;
    protected $response;
    protected $url_robots;
    protected $robots_response;
    protected $robots_size=0;
    protected $content='';
    protected $sitemap_existence=false;
    protected $host_existence=false;
    protected $host_quantity=0;

    /**
     * @return mixed
     */
    public function getRobotsResponse()
    {
        return $this->robots_response;
    }

    /**
     * @return mixed
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getUrlRobots()
    {
        return $this->url_robots;
    }

    /**
     * @return mixed
     */
    public function getRobotsExistence()
    {
        return $this->robots_existence;
    }

    /**
     * @return mixed
     */
    public function getRobotsSize()
    {
        return $this->robots_size;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getSitemapExistence()
    {
        return $this->sitemap_existence;
    }

    /**
     * @return mixed
     */
    public function getHostExistence()
    {
        return $this->host_existence;
    }

    /**
     * @return mixed
     */
    public function getHostQuantity()
    {
        return $this->host_quantity;
    }

    /**
     * @param $url
     */
    public function Run($url)
    {
        $this->response_url($url);
        if (!empty($this->redirect)){
            $this->response_url($this->redirect);
        }
        $this->file_info($this->url_robots);
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param $url
     */
    protected function response_url ($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $this->content=curl_exec($ch);
        $header  = curl_getinfo( $ch );
        curl_close($ch);
        $this->redirect=$header['redirect_url'];
        $this->response=$header['http_code'] ;
        $this->url= $header['url'] ;
        $this->url_robots=$this->url.'robots.txt';
    }

    /**
     * @param $url
     */
    protected function file_info ($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $this->content=curl_exec($ch);
        $header  = curl_getinfo( $ch );
        curl_close($ch);
        $this->robots_size=$header['download_content_length'];
        $this->robots_response=$header['http_code'] ;
        if (substr_count($this->content,"Sitemap:")!=0)
        $this->sitemap_existence= true;
        if (substr_count($this->content,"Host:")==1)
        $this->host_existence=true ;
        $this->host_quantity= substr_count($this->content,"Host:");
    }
}