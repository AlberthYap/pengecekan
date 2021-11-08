<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Image_autorotate
{

    function __construct()
    {
        $this->CI = &get_instance();
    }

    function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    public function resizeFoto($filename = null)
    {
        $source_path = './assets/img/avatar/' . $filename;
        $target_path = '.assets/img/avatar/';

        if ($this->isMobile()) {
            $exif = @exif_read_data($source_path);

            $this->CI->load->library('image_lib');

            $config_manip['image_library'] = 'gd2';
            $config_manip['source_image'] = $source_path;
            $config_manip['width'] = 500;
            $config_manip['new_image'] = $target_path;
            $oris = array();

            switch ($exif['Orientation']) {
                case 1: // no need to perform any changes
                    $oris[] = 0;
                    break;

                case 2: // horizontal flip
                    $oris[] = 'hor';
                    break;

                case 3: // 180 rotate left
                    $oris[] = '180';
                    break;

                case 4: // vertical flip
                    $oris[] = 'ver';
                    break;

                case 5: // vertical flip + 90 rotate right
                    $oris[] = 'ver';
                    $oris[] = '270';
                    break;

                case 6: // 90 rotate right
                    $oris[] = '270';
                    break;

                case 7: // horizontal flip + 90 rotate right
                    $oris[] = 'hor';
                    $oris[] = '270';
                    break;

                case 8: // 90 rotate left
                    $oris[] = '90';
                    break;

                default:
                    $oris[] = 0;
                    break;
            }

            foreach ($oris as $ori) {
                $config_manip['rotation_angle'] = $ori;

                $this->CI->image_lib->initialize($config_manip);
                $this->CI->image_lib->resize();

                $this->CI->image_lib->rotate();
                if (!$this->CI->image_lib->resize()) {
                    echo $this->CI->image_lib->display_errors();
                }
                $this->CI->image_lib->clear();
            }
        } else {
            $config_manip = array(
                'image_library' => 'gd2',
                'source_image' => $source_path,
                'new_image' => $target_path,
                'rotation_angle' => 0,
                'width' => 500,
            );

            $this->CI->image_lib->initialize($config_manip);
            $this->CI->image_lib->resize();
            $this->CI->image_lib->rotate();


            if (!$this->CI->image_lib->resize()) {
                echo $this->CI->image_lib->display_errors();
            }

            $this->CI->image_lib->clear();
        }
    }
}
