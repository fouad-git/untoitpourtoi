<?php
namespace App;


class Twig{
    // avant private $template;    
    /**
     * template
     *
     * @var mixed
     */
    private $template;
    
    /**
     * __construct
     *
     * @param  mixed $template_name
     * @return void
     */
    public function __construct($template_name)
    {
        $loader = new \Twig\Loader\FilesystemLoader(dirname(dirname(__FILE__)).'/template');
        $twig = new \Twig\Environment($loader, [
            'cache' => '/cache',
            'debug' => true,
        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        $this->template = $twig->load($template_name);
    }
    
    /**
     * render
     *
     * @param  mixed $arr
     * @return void
     */
    public function render($arr=[])
    {
        echo $this->template->render($arr);
    }
}
