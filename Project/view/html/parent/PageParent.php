<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 09:35
 */

namespace View;


class PageParent
{
    protected  $docType = "<!DOCTYPE html>";
    
    protected $metaCharset = "<meta charset=\"utf-8\">";

    protected $metaViewport = "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";

    protected $title;

    protected  $body;

    protected $htmlPage;

    protected function renderPage()
    {
        //$this->htmlPage = "";
        $this->htmlPage .= $this->docType;
        $this->htmlPage .= $this->LineFeed();
        $this->htmlPage .= "<html lang=\"sv\">";
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= "<head>";
        $this->htmlPage .= $this->LineFeed(true, 2);
        $this->htmlPage .= $this->metaCharset;
        $this->htmlPage .= $this->LineFeed(true, 2);
        $this->htmlPage .= $this->metaViewport;
        $this->htmlPage .= $this->LineFeed(true, 2);
        $this->htmlPage .= $this->title;
        $this->htmlPage .= $this->LineFeed(true, 2);
        $this->htmlPage .= $this->getBootStrap();
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= "</head>";
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= "<body>";
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= $this->body;
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= "</body>";
        $this->htmlPage .= $this->LineFeed(true, 1);
        $this->htmlPage .= $this->LineFeed(true);
        $this->htmlPage .= "</html>";

        return $this->htmlPage;
    }

    protected function setTitle($title)
    {
        $this->title = "<title>$title</title>";
    }

    protected function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     * Comment: Linefeed For proper html.
     */
    protected function LineFeed($tab = false, $tabs = 0)
    {
        if($tab)
        {
            $ret = "\n";
            for($i=0; $i<$tabs ;$i++)
            {
                $ret .= "\t";
            }
            return $ret;
        }
        return "\n";
    }

    private function getBootStrap()
    {
        $ret =
        '
                <!-- Latest compiled and minified CSS -->
                <link rel="stylesheet"
                    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
                    integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
                    crossorigin="anonymous">' . '
                <!-- Optional theme -->
                <link rel="stylesheet"
                    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"
                    integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX"
                    crossorigin="anonymous">' . '
                <!-- Latest compiled and minified JavaScript -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"
                    integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ=="
                    crossorigin="anonymous">
                </script>
            ';

        return $ret;
    }

}