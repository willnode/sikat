<?php
/**
 * @package Contact :  CodeIgniter Multi Language Loader
 *
 * @author TechArise Team
 *
 * @email  info@techarise.com
 *
 * Description of Multi Language Loader Hook
 */

class MultiLangLoader
{
    public function initialize()
    {
        $ci = &get_instance();
        // load language helper
        //$ci->load->helper('language');

        $siteLang = $ci->session->userdata('site_lang') ?: 'english';
        $ci->lang->load('campus', $siteLang);
    }
}
