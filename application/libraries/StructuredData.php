<?php

/**
 * StructuredData
 *
 * @author Javier
 */
class StructuredData {

    private $data;

    /**
     * Para hacer pruebas debe de valer base_url(), luego se cambia a http://schema.org en el constructor
     * @var string
     */
    private $context;

    /** @var MY_Controller */
    private $ci;

    function __construct() {
        $this->context = 'http://schema.org';
        $this->data = [];
        $this->ci = & get_instance();
        $this->constructGeneralConfig($this->ci->getTitle(), $this->ci->uri->uri_string())
                ->addOrganization()
                ->addPerson()
//                ->addCourses()
        ;
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function __toString() {
        return json_encode($this->data, JSON_UNESCAPED_UNICODE + JSON_UNESCAPED_SLASHES);
    }

    public function constructGeneralConfig($pageTitle, $uri) {
        $this->data[] = [
            "@context" => $this->context,
            "@type" => "WebSite",
            "@id" =>"#website",
            "name" => $pageTitle,
            "url" => base_url($uri),
            "image" => [base_url('assets/images/logo-white-bg.jpg')],
        ];
        return $this;
    }

    public function addPerson() {
        $redes = get_instance()->config->item(CFG_redes);
        $sameAs = [];
        foreach ($redes as $key => $url) {
            if ($url)
                array_push($sameAs, $url);
        }
        $this->data[] = [
            "@context" => $this->context,
            "@type" => "Person",
            "name" => "JavierGordoWEB",
            "url" => base_url(),
            "sameAs" => $sameAs,
        ];
        return $this;
    }

    /**
     * Esta funcion no se esta utilizando hasta que se comiencen a crear cursos
     * @return $this
     */
    public function addCourses() {
        $this->data[] = [
            "@context" => $this->context,
            "@type" => "Course",
            "name" => "xxxx",
            "description" => 'yyyyyy',
            "provider" => [
                "@type" => "Organization",
                "name" => "JavierGordoWEB",
                "sameAs" => base_url('cursos-diseño-web/xxxx'),
            ],
        ];
        return $this;
    }

    public function addOrganization() {
        $this->data[] = [
            "@context" => $this->context,
            "@type" => "Organization",
            "url" => base_url(),
            "logo" => base_url('assets/images/logo-min-javiergordoweb-es.png'),
            "contactPoint" => [
                [
                    "type" => "ContactPoint",
                    "telephone" => $this->ci->config->item(CFG_contact)['phone'],
                    "contactType" => "customer support",
                    "areaServed" => "ES",
                    "availableLanguage" => "Spanish",
                ]
            ],
        ];
        return $this;
    }

    /**
     * funcion utilizada en el controlador para pasar las migas de pan
     * @param array $breadcrumbs [nombre=>url]
     * @return $this
     */
    public function addBreadcrumbListConfig(array $breadcrumbs) {
        $aItemListElement = [];
        $position = 1;
        foreach ($breadcrumbs as $name => $url) {
            $aItemListElement[] = [
                "@type" => "ListItem",
                "position" => $position,
                "item" => [
                    "@id" => $url,
                    "name" => $name,
                ]
            ];
            $position++;
        }

        $this->data[] = [
            "@context" => $this->context,
            "@type" => "BreadcrumbList",
            "itemListElement" => $aItemListElement,
        ];
        return $this;
    }

    public function addRating(){
        
    }
}
