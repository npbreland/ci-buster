<?php
/**
 * Script
 *
 * Generates link to a JS file
 *
 * @param mixed   $src       Script source or an array
 * @param boolean $indexPage Should indexPage be added to the JS path
 * @param boolean $updateOnFileMod Sets version number to file modification time
 *
 * @return string
 */
function script_tag($src = '', bool $indexPage = false, bool $updateOnFileMod = false): string
{
    $script = '<script ';
    if (! is_array($src))
    {
        $src = ['src' => $src];
    }

    foreach ($src as $k => $v)
    {
        if ($k === 'src' && ! preg_match('#^([a-z]+:)?//#i', $v))
        {
            if ($indexPage === true)
            {
                $script .= 'src="' . site_url($v) . '" ';
            }
            else
            {
                if ($updateOnFileMod)
                {
                    $path = ROOTPATH . '/public/' . $v;
                    $filemtime = filemtime($path);
                    $script .= 'src="' . slash_item('baseURL') . $v . '?v'. $filemtime .'" ';
                }
                else
                {
                    $script .= 'src="' . slash_item('baseURL') . $v .'" ';
                }
                
            }
        }
        else
        {
            $script .= $k . '="' . $v . '" ';
        }
    }

    return $script . 'type="text/javascript"' . '></script>';
}

/**
 * Link
 *
 * Generates link to a CSS file
 *
 * @param mixed   $href      Stylesheet href or an array
 * @param string  $rel
 * @param string  $type
 * @param string  $title
 * @param string  $media
 * @param boolean $indexPage should indexPage be added to the CSS path.
 * @param string  $hreflang
 *
 * @return string
 */
function link_tag($href = '', string $rel = 'stylesheet', string $type = 'text/css', string $title = '', string $media = '', bool $indexPage = false, string $hreflang = '', $updateOnFileMod = false): string
{
    $link = '<link ';

    // extract fields if needed
    if (is_array($href))
    {
        $rel       = $href['rel'] ?? $rel;
        $type      = $href['type'] ?? $type;
        $title     = $href['title'] ?? $title;
        $media     = $href['media'] ?? $media;
        $hreflang  = $href['hreflang'] ?? '';
        $indexPage = $href['indexPage'] ?? $indexPage;
        $href      = $href['href'] ?? '';
    }

    if (! preg_match('#^([a-z]+:)?//#i', $href))
    {
        if ($indexPage === true)
        {
            $link .= 'href="' . site_url($href) . '" ';
        }
        else
        {
            
            if ($updateOnFileMod)
            {
                $path = ROOTPATH . '/public/' . $href;
                $filemtime = filemtime($path);
                $link .= 'href="' . slash_item('baseURL') . $href . '?v'. $filemtime . '" ';
            } 
            else
            {
                $link .= 'href="' . slash_item('baseURL') . $href . '" ';
            }
        }
    }
    else
    {
        $link .= 'href="' . $href . '" ';
    }

    if ($hreflang !== '')
    {
        $link .= 'hreflang="' . $hreflang . '" ';
    }

    $link .= 'rel="' . $rel . '" ';

    if (! in_array($rel, ['alternate', 'canonical'], true))
    {
        $link .= 'type="' . $type . '" ';
    }

    if ($media !== '')
    {
        $link .= 'media="' . $media . '" ';
    }

    if ($title !== '')
    {
        $link .= 'title="' . $title . '" ';
    }

    return $link . '/>';
}