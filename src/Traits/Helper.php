<?php
namespace GS\GSTraits;

/**
 * Method load assest files from assets map
 */
trait registerAssets {
    /**
     * Include the necessary sortable metabox scripts.
     */
    public function scripts() {
        foreach ($this->assets_map as $map) {
            preg_match_all(
                '/(?P<type>.*):(?P<sub>.*):(?P<key>.*):(?P<file>.*)/',
                $map,
                $matches
            );
            $path = GSPL_URL . 'assets';
            $style = $script = false;
            
            switch ($matches['type'][0]) {
                case 's':
                    $path .= '/styles';
                    $style = true;
                    break;
                case 'j':
                    $path .= '/scripts';
                    $script = true;
                    break;
                default:
                    # code...
                    break;
            }

            switch ($matches['sub'][0]) {
                case 'c':
                    $path .= '/components';
                    break;
                case 'g':
                    $path .= '/global';
                    break;
                default:
                    # code...
                    break;
            }

            if ($style == true) {
                $path .= '/'.$matches['file'][0].'.css';
                wp_enqueue_style(
                    $matches['key'][0],
                    $path,
                    false,
                    GSPL_VER
                );
            }

            if ($script == true) {
                $path .= '/'.$matches['file'][0].'.js';
                wp_enqueue_script(
                    $matches['key'][0],
                    $path,
                    array(),
                    GSPL_VER,
                    true
                );
            }
        }

        // import cloud 9 ace script
        wp_enqueue_script(
            'ace',
            '//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js',
            array(),
            GSPL_VER,
            true
        );
    }
}

/**
 * @TODO create button
 */
trait createButton {
    /**
     * Create button
     */
    public function createButton($text = '', $type = 'primary success', $name = 'submit', $wrap = true, $other_attributes = '')
    {
        if (!is_array($type)) $type = explode(' ', $type);

        $button_shorthand = array('primary', 'small', 'large');
        $classes = array('btn');

        foreach ( $type as $t ) {
            if ('secondary' === $t || 'btn-secondary' === $t) continue;
            $classes[] = in_array($t, $button_shorthand) ? 'btn-' . $t : $t;
        }

        $class = implode(' ', array_unique($classes));

        if ('delete' === $type) $class = 'btn-danger';

        $text = $text ? $text : __('Save Changes');
        $id = $name;
        if (is_array($other_attributes) && isset($other_attributes['id'])) {
            $id = $other_attributes['id'];
            unset($other_attributes['id']);
        }

        $attributes = '';
        if (is_array($other_attributes)) {
            foreach ($other_attributes as $attribute => $value) {
                $attributes .= $attribute . '="' . esc_attr($value) . '" '; // Trailing space is important
            }
        } elseif (!empty($other_attributes)) { // Attributes provided as a string
            $attributes = $other_attributes;
        }

        // Don't output empty name and id attributes.
        $name_attr = $name ? ' name="' . esc_attr($name) . '"' : '';
        $id_attr = $id ? ' id="' . esc_attr($id) . '"' : '';

        $button = '<input type="submit"' . $name_attr . $id_attr . ' class="' . esc_attr($class);
        $button .= '" value="' . esc_attr($text) . '" ' . $attributes . ' />';

        if ($wrap) {
            $button = '<p class="submit">' . $button . '</p>';
        }

        return $button;
    }

    /**
     * Echo button
     */
    public function submitButton($text = null, $type = 'primary', $name = 'submit', $wrap = true, $other_attributes = null) {
        echo $this->createButton($text, $type, $name, $wrap, $other_attributes);
    }
}