<?php
// This file is part of the elegance theme for Moodle
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme elegance widget renderers file.
 *
 * @package    theme_elegance
 * @copyright  2015 Bas Brands
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class theme_elegance_widgets_renderer extends plugin_renderer_base {
    
    public function banner($hasbanner) {
        if (!$hasbanner) {
            return '';
        }

        $theme = theme_config::load('elegance');
        $settings = $theme->settings;
        $slidenum = $settings->slidenumber;

        $template = new Object();
        $banners = array();
        foreach (range(1, $slidenum) as $bannernumber) {
            $banner = new Object();
            $enablebanner = 'enablebanner' . $bannernumber;
            $banner->enablebanner = (!empty($settings->$enablebanner));

            $bannerimage = 'bannerimage' . $bannernumber;
            $bannerimageset = (!empty($settings->$bannerimage));
            if ($bannerimageset) {
                $banner->bannerimage = $theme->setting_file_url($bannerimage, $bannerimage);
            }

            $bannertitle = 'bannertitle' . $bannernumber;
            if (!empty($settings->$bannertitle)) {
                $banner->bannertitle = $settings->$bannertitle;
            } else {
                $banner->bannertitle = false;
            }

            $bannertext = 'bannertext' . $bannernumber;
            if (!empty($settings->$bannertext)) {
                $banner->bannertext = $settings->$bannertext;
            } else {
                $banner->bannertext = false;
            }

            $bannerurl = 'bannerurl' . $bannernumber;
            if (!empty($settings->$bannerurl)) {
                $banner->bannerurl = $settings->$bannerurl;
            } else {
                $banner->bannerurl = false;
            }

            $bannerlinktext = 'bannerlinktext' . $bannernumber;
            if (!empty($settings->$bannerlinktext)) {
                $banner->bannerlinktext = $settings->$bannerlinktext;
            } else {
                $banner->bannerlinktext = false;
            }
            $banners[] = $banner;
        }
        $template->banners = $banners;

        return $this->render_from_template('theme_elegance/banner', $template);
    }

    public function marketing_spots($hasmarketing) {
        if (!$hasmarketing) {
            return '';
        }

        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        $spotsnr = $settings->marketingspotsnr;
        $template = new Object();
        $template->spots = array();
        $template->title = '';
        $template->marketingtitletitleicon = '';
        if (!empty($settings->marketingtitle)) {
            $template->marketingtitle = $settings->marketingtitle;

        }
        if (!empty($settings->marketingtitleicon)) {
            $template->marketingtitleicon = $settings->marketingtitleicon;
        }

        $choices = array();
        $choices[1] = 'col-sm-6 col-md-6';//2;
        $choices[2] = 'col-xs-6 col-sm-4 col-md-3';//4
        $choices[3] = 'col-xs-6 col-sm-3 col-md-2';//6;
        $choices[4] = 'col-xs-6 col-sm-3 col-md-2 col-lg-1';//12;

        if (!empty($settings->marketingspotsinrow)) {
            $template->spotclass = $choices[$settings->marketingspotsinrow];
        } else {
            $template->spotclass = $choices[2];
        }

        foreach (range(1, $spotsnr) as $spot) {
            $title = 'marketingtitle' . $spot;
            $icon = 'marketingicon' . $spot;
            $content = 'marketingcontent' . $spot;
            $url = 'marketingurl' . $spot;

            $marketingspot = new Object();
            if (!empty($settings->$title)) {
                $marketingspot->title = $settings->$title;
            }
            if (!empty($settings->$icon)) {
                $marketingspot->icon = $settings->$icon;
            }
            if (!empty($settings->$content)) {
                $marketingspot->content = $settings->$content;
            }
            if (!empty($settings->$url)) {
                $marketingspot->url = $settings->$url;
            }
            $template->spots[] = $marketingspot;
        } 

        return $this->render_from_template('theme_elegance/marketingspots', $template);
    }
    public function footerleft($hasfooter) {
                if (!$hasfooter) {
            return '';
        }
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        $template = new Object();
        $template->footnote = $settings->footnote;

        return $this->render_from_template('theme_elegance/footerleft', $template);
    }

    public function footerright($hasfooter) {
        if (!$hasfooter) {
            return '';
        }
        $theme = theme_config::load('elegance');
        $settings = $theme->settings;

        $template = new Object();

        $socialoptions = array('facebook', 'twitter', 'googleplus', 'linkedin', 'youtube', 'flickr', 'vk', 'pinterest',
            'instagram', 'skype', 'website', 'blog', 'vimeo', 'tumblr');

        foreach ($socialoptions as $so) {
            if (!empty($settings->$so)) {
                $template->$so = $settings->$so;
                $template->hasicons = true;
            }
        }
        return $this->render_from_template('theme_elegance/footerright', $template);
    }
}