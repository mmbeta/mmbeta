<?php
/**
 * In this file I set up custom fields for:
 * - Preisträger-Profilseiten
 * - Seitenanzeige über der Preis-Kategorieübersicht
 * - Twitter-Einstellungen
 * - Homepage
 * @package medium_magazin_beta
 */

//Custom fields for Preisträger
if(function_exists("register_field_group")){
  register_field_group(array (
    'id' => 'acf_post-fields',
    'title' => 'Post-Fields',
    'fields' => array (
      array (
        'key' => 'field_569f7b999eb0d',
        'label' => 'Showcase-Slider',
        'name' => 'slider',
        'type' => 'text',
        'instructions' => 'In dieses Feld können Sie den Alias (maschinenlesbaren Namen) eines Revolution Sliders eintragen, damit dieser über dem Post angezeigt wird.',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      )
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'post',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'preistraeger',
          'order_no' => 0,
          'group_no' => 1,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'acf_preistrager-felder',
    'title' => 'Preisträger-Felder',
    'fields' => array (
      array (
        'key' => 'field_568c54a877aa9',
        'label' => 'Platz',
        'name' => 'platz',
        'type' => 'number',
        'instructions' => 'Zum Beispiel: 1 wenn Platz 1 von 10',
        'required' => 1,
        'default_value' => 1,
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'min' => 1,
        'max' => 10,
        'step' => 1,
      ),
      array (
        'key' => 'field_5690fbcdd9c84',
        'label' => 'Preis-Titel',
        'name' => 'preis-titel',
        'type' => 'text',
        'instructions' => 'z.B. Journalistin des Jahres oder Kulturjournalist des Jahres. Wenn nicht ausgefüllt, erscheint zB. Platz 8, Kategorie Kultur ',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5690fcafd9c85',
        'label' => 'Vorname',
        'name' => 'vorname',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_5690fb23d9c83',
        'label' => 'Nachname',
        'name' => 'nachname',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_568c5b142551c',
        'label' => 'Position',
        'name' => 'position',
        'type' => 'text',
        'instructions' => 'In welcher Position/Funktion wurde die Person ausgezeichnet?',
        'required' => 1,
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_568c5b142551c9twitter',
        'label' => 'Twitter-Handle',
        'name' => 'twitter',
        'type' => 'text',
        'instructions' => 'Das Twitter-Handle des Preisträgers ohne @-Zeichen',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_568c5b142551c9website-label',
        'label' => 'Website Linktext',
        'name' => 'website_label',
        'type' => 'text',
        'instructions' => 'Link-Text der Website. Z.B. "Blog" oder "Profil"',
        'default_value' => '',
        'placeholder' => 'Web',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_568c5b142551c9website',
        'label' => 'Website',
        'name' => 'website',
        'type' => 'url',
        'instructions' => 'Link zur Homepage bzw. zum Blog des Preisträgers',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_57b2217703636geburtstag',
        'label' => 'Geburtsdatum',
        'name' => 'geburtsdatum',
        'type' => 'date_picker',
        'instructions' => 'Tragen Sie hier das Geburtsdatum des Preisträgers ein.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array (
          'width' => 45,
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'd. M Y',
        'return_format' => 'm/d/Y',
        'first_day' => 1,
      ),
      array (
        'key' => 'field_568c5b142551c977geb-fallback',
        'label' => 'Geburtsdatum Fallback',
        'name' => 'geburtsdatum-fallback',
        'type' => 'text',
        'instructions' => 'Wenn kein Geburtsdatum im Format Tag/Monat/Jahr angegeben werden soll, tragen Sie hier ins Freitextfeld ein, was stattdessen erscheinen soll. Falls kein Geburtstag angezeigt werden soll, lassen Sie beide Felder leer.',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_568c592ec49ed',
        'label' => 'Haupttext',
        'name' => 'begruendung',
        'type' => 'wysiwyg',
        'instructions' => 'Hier können Sie die Jury-Begründung oder den Fragebogen eines Preisträgers eintragen',
        'default_value' => '',
        'toolbar' => 'basic',
        'media_upload' => 'no',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'preistraeger',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'acf_after_title',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));

// Add Custom Field to set pages to display on top of preise taxonomy

  register_field_group(array (
    'id' => 'acf_seite-in-preis-taxonomy',
    'title' => 'Seite in Preis Taxonomy',
    'fields' => array (
      array (
        'key' => 'field_56f81698b3aec',
        'label' => 'Seite für Preis',
        'name' => 'preis_seite',
        'type' => 'relationship',
        'instructions' => 'Hier können Sie eine Seite auswählen, deren Inhalt über der Preisträger-Übersicht dieser Kategorie angezeigt wird. Bei Jahrgängen (2015/2016...) wird hier die Jahrgangsübersicht ausgewählt - das ist beim Einsatz von Laterpay der Inhalt der gekauft werden muss, um Zugriff auf die einzelnen Preisträger zu haben.',
        'return_format' => 'id',
        'post_type' => array (
          0 => 'page',
          1 => 'post',
        ),
        'taxonomy' => array (
          0 => 'all',
        ),
        'filters' => array (
          0 => 'search',
        ),
        'result_elements' => array (
          0 => 'post_type',
          1 => 'post_title',
        ),
        'max' => 1,
      ),
      array (
        'key' => 'field_56f8optionsShowCat',
        'label' => 'Kategorie-Tags anzeigen',
        'name' => 'show_cat_tags',
        'type' => 'true_false',
        'instructions' => 'Sollen auf den Preisträgerseiten dieser Kategorie Tags der anderen Kategorien angezeigt werden?',
        'message' => 'Tags anzeigen?',
        'default_value' => 1,
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'ef_taxonomy',
          'operator' => '==',
          'value' => 'preise',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}

// Homepage

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_57f40951cbdb5',
  'title' => 'Homepage',
  'fields' => array (
    array (
      'key' => 'field_57f409563303f',
      'label' => 'Homepage-Slider',
      'name' => 'homepage-slider',
      'type' => 'text',
      'instructions' => 'Geben Sie hier den Slug des Sliders ein, der auf der Homepage angezeigt werden soll. Einen neuen Slider können Sie unter "Slider Revolution" anlegen.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => 'hp-slider',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
      'readonly' => 0,
      'disabled' => 0,
    ),
    array (
      'key' => 'field_57f40a1033040',
      'label' => 'Homepage',
      'name' => 'homepage',
      'type' => 'flexible_content',
      'instructions' => 'Fügen Sie hier Teasergruppen, Zitate, Tweets und weitere Elemente der Homepage hinzu.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'button_label' => 'Element hinzufügen',
      'min' => '',
      'max' => '',
      'layouts' => array (
        array (
          'key' => '57f40e79f19d6',
          'name' => 'teasergruppe',
          'label' => 'Teasergruppe',
          'display' => 'row',
          'sub_fields' => array (
            array (
              'key' => 'field_57f40fc633041',
              'label' => 'Teaser-Anzahl',
              'name' => 'teaser-anzahl',
              'type' => 'select',
              'instructions' => 'Ein vollbreiter, zwei halb oder drei drittelbreite Teaser?',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '10',
                'class' => '',
                'id' => '',
              ),
              'choices' => array (
                1 => '1',
                2 => '2',
                3 => '3',
              ),
              'default_value' => array (
                0 => 3,
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'ui' => 0,
              'ajax' => 0,
              'return_format' => 'value',
              'placeholder' => '',
            ),
            array (
              'key' => 'field_57f4118233042',
              'label' => 'Linkziel',
              'name' => 'linkziel_1',
              'type' => 'post_object',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'post_type' => array (
              ),
              'taxonomy' => array (
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'return_format' => 'id',
              'ui' => 1,
            ),
            array (
              'key' => 'field_57f413b033044',
              'label' => 'Linkziel 2',
              'name' => 'linkziel_2',
              'type' => 'post_object',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '!=',
                    'value' => '1',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'post_type' => array (
              ),
              'taxonomy' => array (
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'return_format' => 'id',
              'ui' => 1,
            ),
            array (
              'key' => 'field_57f413d633045',
              'label' => 'Linkziel 3',
              'name' => 'linkziel_3',
              'type' => 'post_object',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '==',
                    'value' => '3',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'post_type' => array (
              ),
              'taxonomy' => array (
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'return_format' => 'id',
              'ui' => 1,
            ),
            array (
              'key' => 'field_57f4122b33043',
              'label' => 'Teasertext',
              'name' => 'teaser-text_1',
              'type' => 'textarea',
              'instructions' => 'Mit diesem Text können sie den Vorspann überschreiben, der am verlinkten Beitrag im "Auszug"-Feld steht.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'maxlength' => '',
              'rows' => 5,
              'new_lines' => '',
            ),
            array (
              'key' => 'field_57f413e733046',
              'label' => 'Teasertext 2',
              'name' => 'teaser-text_2',
              'type' => 'textarea',
              'instructions' => 'Mit diesem Text können sie den Vorspann überschreiben, der am verlinkten Beitrag im "Auszug"-Feld steht.',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '!=',
                    'value' => '1',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'maxlength' => '',
              'rows' => 5,
              'new_lines' => '',
            ),
            array (
              'key' => 'field_57f4140233047',
              'label' => 'Teasertext 3',
              'name' => 'teaser-text_3',
              'type' => 'textarea',
              'instructions' => 'Mit diesem Text können sie den Vorspann überschreiben, der am verlinkten Beitrag im "Auszug"-Feld steht.',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '==',
                    'value' => '3',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'maxlength' => '',
              'rows' => 5,
              'new_lines' => '',
            ),
            array (
              'key' => 'field_5805dd03a8002',
              'label' => 'Teaserform 1',
              'name' => 'teaserform_1',
              'type' => 'radio',
              'instructions' => 'Wie soll das Bild dargestellt werden?',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '30',
                'class' => '',
                'id' => '',
              ),
              'choices' => array (
                'breit' => 'breit',
                'quadratisch' => 'quadratisch',
                'hoch' => 'hoch',
                'rund' => 'rund',
              ),
              'allow_null' => 0,
              'other_choice' => 0,
              'save_other_choice' => 0,
              'default_value' => '',
              'layout' => 'horizontal',
              'return_format' => 'value',
            ),
            array (
              'key' => 'field_5805dde5a8003',
              'label' => 'Teaserform 2',
              'name' => 'teaserform_2',
              'type' => 'radio',
              'instructions' => 'Wie soll das Bild von Teaser 2 dargestellt werden?',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '!=',
                    'value' => '1',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '30',
                'class' => '',
                'id' => '',
              ),
              'choices' => array (
                'breit' => 'breit',
                'quadratisch' => 'quadratisch',
                'hoch' => 'hoch',
                'rund' => 'rund',
              ),
              'allow_null' => 0,
              'other_choice' => 0,
              'save_other_choice' => 0,
              'default_value' => '',
              'layout' => 'horizontal',
              'return_format' => 'value',
            ),
            array (
              'key' => 'field_5805de0aa8004',
              'label' => 'Teaserform 3',
              'name' => 'teaserform_3',
              'type' => 'radio',
              'instructions' => 'Wie soll das Bild von Teaser 2 dargestellt werden?',
              'required' => 0,
              'conditional_logic' => array (
                array (
                  array (
                    'field' => 'field_57f40fc633041',
                    'operator' => '==',
                    'value' => '3',
                  ),
                ),
              ),
              'wrapper' => array (
                'width' => '30',
                'class' => '',
                'id' => '',
              ),
              'choices' => array (
                'breit' => 'breit',
                'quadratisch' => 'quadratisch',
                'hoch' => 'hoch',
                'rund' => 'rund',
              ),
              'allow_null' => 0,
              'other_choice' => 0,
              'save_other_choice' => 0,
              'default_value' => '',
              'layout' => 'horizontal',
              'return_format' => 'value',
            ),
          ),
          'min' => '',
          'max' => '',
        ),
        array (
          'key' => '57f4178549838',
          'name' => 'zitat',
          'label' => 'Zitat',
          'display' => 'block',
          'sub_fields' => array (
            array (
              'key' => 'field_57f417a749839',
              'label' => 'Zitat-Text',
              'name' => 'zitat-text',
              'type' => 'wysiwyg',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'tabs' => 'all',
              'toolbar' => 'basic',
              'media_upload' => 1,
            ),
            array (
              'key' => 'field_5804c81b363e8',
              'label' => 'Zitatgeber',
              'name' => 'zitatgeber',
              'type' => 'text',
              'instructions' => 'Der Name des Zitatgebers.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
            ),
            array (
              'key' => 'field_58071bd088cec',
              'label' => 'Farbe',
              'name' => 'color',
              'type' => 'select',
              'instructions' => 'Welche Farbe soll der Hintergrund haben?',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'choices' => array (
                'blau' => 'Blau',
                'magenta' => 'Magenta',
                'gruen' => 'Grün',
                'rot' => 'Rot',
                'orange' => 'Orange',
                'petrol' => 'Petrol',
              ),
              'default_value' => array (
              ),
              'allow_null' => 0,
              'multiple' => 0,
              'ui' => 0,
              'ajax' => 0,
              'return_format' => 'value',
              'placeholder' => '',
            ),
            array (
              'key' => 'field_580724ee06379',
              'label' => 'Zitat-Link',
              'name' => 'zitat-link',
              'type' => 'url',
              'instructions' => 'Wohin soll der Zitat-Teaser linken?',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
            ),
          ),
          'min' => '',
          'max' => '',
        ),
        array (
          'key' => '57f418b34983a',
          'name' => 'preistraeger-slider',
          'label' => 'Preisträger-Slider',
          'display' => 'block',
          'sub_fields' => array (
            array (
              'key' => 'field_57f418d14983b',
              'label' => 'Kopf-Slider',
              'name' => 'kopf-slider',
              'type' => 'taxonomy',
              'instructions' => 'Wählen Sie den Preis aus, von dem die Preisträger-Köpfe in der Galerie erscheinen sollen.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'taxonomy' => 'preise',
              'field_type' => 'select',
              'allow_null' => 0,
              'add_term' => 1,
              'save_terms' => 0,
              'load_terms' => 0,
              'return_format' => 'object',
              'multiple' => 0,
            ),
            array (
              'key' => 'field_5809ddb36296b',
              'label' => 'Farbe',
              'name' => 'color',
              'type' => 'clone',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'clone' => array (
                0 => 'field_58071bd088cec',
              ),
              'display' => 'seamless',
              'layout' => 'block',
              'prefix_label' => 0,
              'prefix_name' => 0,
            ),
            array (
              'key' => 'field_580a057c2a98b',
              'label' => 'Titel',
              'name' => 'slider_titel',
              'type' => 'text',
              'instructions' => 'Geben Sie einen Titel an, wenn einer über der Galerie angezeigt werden soll.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
            ),
          ),
          'min' => '',
          'max' => '',
        ),
        array (
          'key' => '5817cdf2b6dd1',
          'name' => 'cover-slider',
          'label' => 'Cover-Slider',
          'display' => 'block',
          'sub_fields' => array (
            array (
              'key' => 'field_5817cdf2b6dd2',
              'label' => 'Cover-Slider',
              'name' => 'cover-slider',
              'type' => 'taxonomy',
              'instructions' => 'Wählen Sie die Kategorie aus, deren Posts in der Galerie angezeigt werden sollen. Wenn Sie nichts auswählen, wird die Kategorie "Ausgabe" ausgewählt.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'taxonomy' => 'category',
              'field_type' => 'select',
              'allow_null' => 1,
              'add_term' => 0,
              'save_terms' => 0,
              'load_terms' => 0,
              'return_format' => 'object',
              'multiple' => 0,
            ),
            array (
              'key' => 'field_5817cdf2b6dd3',
              'label' => 'Farbe',
              'name' => 'color',
              'type' => 'clone',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'clone' => array (
                0 => 'field_58071bd088cec',
              ),
              'display' => 'seamless',
              'layout' => 'block',
              'prefix_label' => 0,
              'prefix_name' => 0,
            ),
            array (
              'key' => 'field_5817cdf2b6dd4',
              'label' => 'Titel',
              'name' => 'slider_titel',
              'type' => 'text',
              'instructions' => 'Geben Sie einen Titel an, wenn einer über der Galerie angezeigt werden soll.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
            ),
          ),
          'min' => '',
          'max' => '',
        ),
        array (
          'key' => '57f41a314983c',
          'name' => 'social-teaser',
          'label' => 'Social-Teaser',
          'display' => 'block',
          'sub_fields' => array (
            array (
              'key' => 'field_57f41a684983d',
              'label' => 'Tweet',
              'name' => 'tweet',
              'type' => 'oembed',
              'instructions' => 'Fügen Sie hier den Link zu einem Tweet ein.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '100',
                'class' => 'embed-container',
                'id' => '',
              ),
              'width' => 640,
              'height' => '',
            ),
            array (
              'key' => 'field_580e702206b8b',
              'label' => 'Facebook',
              'name' => 'facebook',
              'type' => 'url',
              'instructions' => 'Geben Sie den Link zu einem bestimmten Facebook-Status ein, oder lassen Sie das Feld leer, wenn der aktuellste Post gezeigt werden soll.',
              'required' => 0,
              'conditional_logic' => 0,
              'wrapper' => array (
                'width' => '',
                'class' => '',
                'id' => '',
              ),
              'default_value' => '',
              'placeholder' => '',
            ),
          ),
          'min' => '',
          'max' => '',
        ),
      ),
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'page-templates/template_home.php',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'acf_after_title',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => array (
    0 => 'permalink',
    1 => 'the_content',
    2 => 'excerpt',
    3 => 'custom_fields',
    4 => 'discussion',
    5 => 'comments',
    6 => 'revisions',
    7 => 'slug',
    8 => 'author',
    9 => 'format',
    10 => 'page_attributes',
    11 => 'featured_image',
    12 => 'categories',
    13 => 'tags',
    14 => 'send-trackbacks',
  ),
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_570d63b67674d-2',
  'title' => 'Twitter Einstellungen',
  'fields' => array (
    array (
      'key' => 'field_5815f9e2faa74',
      'label' => 'Twitter Consumer Key (API Key)',
      'name' => 'twitter_api_key',
      'type' => 'text',
      'instructions' => 'Auf https://apps.twitter.com/ können Sie eine Twitter-App erstellen und dann den API-Key hier einfügen.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_5815fa9efaa75',
      'label' => 'Twitter Consumer Secret',
      'name' => 'twitter_secret',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_5815fd1f664fe',
      'label' => 'Twitter Access Token',
      'name' => 'twitter_access_token',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_5815fd52664ff',
      'label' => 'Twitter Access Token Secret',
      'name' => 'twitter_access_token_secret',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'acf-options-mmbeta-settings',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

acf_add_local_field_group(array (
  'key' => 'group_597df6a44939b',
  'title' => 'Facebook Einstellungen',
  'fields' => array (
    array (
      'key' => 'field_597df6a44b21a',
      'label' => 'Facebook App ID',
      'name' => 'facebook_app_id',
      'type' => 'text',
      'instructions' => 'Auf https://developers.facebook.com/ können Sie eine Facebook-App erstellen und dann die App-ID hier einfügen.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
    array (
      'key' => 'field_597df6a44b22b',
      'label' => 'Facebook App Secret',
      'name' => 'facebook_secret',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
      'maxlength' => '',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'options_page',
        'operator' => '==',
        'value' => 'acf-options-mmbeta-settings',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => '',
));

endif;

// Preisträger-Übersicht

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
  'key' => 'group_587231c7a4c82',
  'title' => 'Preisträger-Liste',
  'fields' => array (
    array (
      'key' => 'field_587231eb645da',
      'label' => 'Preis',
      'name' => 'preis_to_show',
      'type' => 'taxonomy',
      'instructions' => 'Wähle hier aus, Preisträger welches Preises (z.B. Top30 2016, JDJ 2015...) auf der Seite gelistet werden sollen.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'taxonomy' => 'preise',
      'field_type' => 'checkbox',
      'allow_null' => 0,
      'add_term' => 0,
      'save_terms' => 0,
      'load_terms' => 0,
      'return_format' => 'object',
      'multiple' => 0,
    ),
    array (
      'key' => 'field_58723badda55c',
      'label' => 'Header-Text',
      'name' => 'header-text',
      'type' => 'textarea',
      'instructions' => 'Wenn Du hier Text einträgst, wird er im farbig hinterlegten Header der Übersichtsseite angezeigt. Darunter folgt der Inhalt des großen Textfeldes.',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array (
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
      'maxlength' => '',
      'rows' => '',
      'new_lines' => 'wpautop',
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'page_template',
        'operator' => '==',
        'value' => 'page-templates/template-preistraeger-liste.php',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'seamless',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => 1,
  'description' => 'Anzeige von Preisträgern',
));

endif;

?>