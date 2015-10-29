<?php
/**
 * Created by PhpStorm.
 * User: AndreasAnemyr
 * Date: 2015-10-27
 * Time: 03:47
 */

namespace View;


class Index extends PageParent
{
    //Different content/pages
    protected static $index = 'Index';
    protected static $bigWishList = 'BigWishList';
    protected static $PersonWishList = 'PersonWishList';
    protected static $uid = 'Uid';

    private $dal;

    private function SetDAL(\model\dal $dal)
    {
        $this->dal = $dal;
    }

    public function GetPage(\model\dal $dal)
    {
        $this->SetDal($dal);
        $this->SetBody($this->RenderBody());
        // Secure едц.
        echo $this->renderPage();
    }

    protected function RenderBody()
    {
        $this->setTitle("I wish...");
        $body = $this->GetNavbar();
        // Index no page selected..
        if($this->GetPageRequested() == "")
        {
            $body .= "<div class=\"container\">";
            $body .= $this->GetDefaultContent();
            $body .= "</div>";
        }
        else
        {
            $body .= "<div class=\"container\">";
            $body .= $this->SwitchContentToRenderInBody();
            $body .= "</div>";
        }
        return $body;
    }

    /**
     * @return string
     * The page requested by client.
     * If not isset function returns ""
     */
    public function GetPageRequested()
    {
        if(isset($_GET['page']))
        {
            return $_GET['page'];
        }
        else
        {
            return "";
        }
    }

    /**
     * @return string
     */
    private function GetNavbar()
    {
        $navbar =
            "
            <nav class=\"navbar navbar-default\">
              <div class=\"container-fluid\">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class=\"navbar-header\">
                  <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                  </button>
                  <a class=\"navbar-brand\" href=\"#\">IWish</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class=\"collapse navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
                  <ul class=\"nav navbar-nav\">
                    <li><a href=\"?page=" . self::$bigWishList . "\">Big Wishlist<span class=\"sr-only\">(current)</span></a></li>
                    <li><a href=\"#\">Login</a></li>
                  </ul>
                  <form class=\"navbar-form navbar-left\" role=\"search\">
                    <div class=\"form-group\">
                      <input type=\"text\" class=\"form-control\" placeholder=\"Search\">
                    </div>
                    <button type=\"submit\" class=\"btn btn-default\">Submit</button>
                  </form>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
            ";
        return $navbar;
    }

    public function GetDefaultContent()
    {
        return "Empty page - no content!";
    }

    private function SwitchContentToRenderInBody()
    {
        switch($this->GetPageRequested())
        {
            case self::$bigWishList :
                $page = new BigWishList();
                return $page->getContent($this->dal);
            break;
            case self::$PersonWishList :
                $page = new PersonWishList();
                return $page->getContent($this->dal);
                break;
        }
    }


}