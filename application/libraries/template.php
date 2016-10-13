<?php

/**
 * Renders the template for the GPS website
 */
class Template{
    
    private $CI;                            // CI instance
    private $_viewData = array();           // The view data
    private $_viewPath = "";                // The view file path
    
    public function __construct() {
        $this->CI = & get_instance();
    }

    public function setViewData($data = array()){ $this->_viewData = $data; return $this; }
    public function setViewPath($path = ""){ $this->_viewPath = $path; return $this; }
    
    /**
     * Renders the output
     *
     * If a compiledView is provided, it simply uses it. Otherwise it uses the
     * _viewData and _viewPath to first compile the view and the print it.
     * 
     * @param  html $compiledView The compiled view (optional)
     */
    public function render($compiledView = false){

        // Render the header
        $this->CI->load->view('templates/header', array());

        // Use a compiled view if provided otherwise compile it youeself
        if ($compiledView !== false)
            $html = $compiledView;
        else
            $html = $this->CI->load->view($this->_viewPath, $this->_viewData, true);
            

        // Render the middle
        $this->CI->load->view('templates/middle', array(
            // "sidemenu" => $this->CI->load->view('layout/sidemenu', array(), true),
            "htmlContent" => $html));
            // "breadcrumbs" => $this->_breadcrumbs));

        // Render the footer
        $this->CI->load->view('templates/footer');
    }

}

?>
