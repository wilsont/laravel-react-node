<?php

namespace App\React;
use GuzzleHttp\Client;

class React
{
    private $defaultOptions;

    public function __construct()
    {
        $this->defaultOptions = [
            'prerender' => config('react.prerender'),
            'tag' => 'div'
        ];
    }

    //Fire a post to the express server, passing the component name and props for rendering the react component
    private function renderReact($component, $props)
    {
        $client = new Client(['base_uri' => 'http://localhost:'.config('react.port')]);
        $response = $client->post('/'.$component, [
            'json' => [
                'props' => $props
            ]
        ]);
        return $response->getBody()->getContents();
    }

    /**
     * Render a ReactJS component.
     *
     * @param string $component Name of the component object
     * @param array  $props     Associative array of props of the component
     * @param array  $options   Associative array of options of rendering
     *
     * @return string Markup of the rendered component
     */
    public function render($component, $props = [], $options = [])
    {
        $options = array_merge($this->defaultOptions, $options);
        $tag = $options['tag'];
        $markup = '';


        // Creates the markup of the component
        if ($options['prerender'] === true) {
            $markup = $this->renderReact($component, $props);
        }

        // Pass props back to view as value of `data-react-props`
        $props = htmlentities(json_encode($props), ENT_QUOTES);

        // Gets all values that aren't used as options and map it as HTML attributes
        $htmlAttributes = array_diff_key($options, $this->defaultOptions);
        $htmlAttributesString = $this->arrayToHTMLAttributes($htmlAttributes);

        return "<{$tag} data-react-class='{$component}' data-react-props='{$props}' {$htmlAttributesString}>{$markup}</{$tag}>";
    }

    /**
     * Convert associative array to string of HTML attributes.
     *
     * @param array $array Associative array of attributes
     *
     * @return string
     */
    private function arrayToHTMLAttributes($array)
    {
        $htmlAttributesString = '';
        foreach ($array as $attribute => $value) {
            $htmlAttributesString .= "{$attribute}='{$value}'";
        }

        return $htmlAttributesString;
    }
}
