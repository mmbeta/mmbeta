# medium magazin
Das Theme mmbeta ist unter https://github.com/mmbeta/mmbeta auf Github verfügbar. Ich würde die Kollegen, die es in Zukunft bearbeiten werden als Contributor eintragen und ihnen auch gerne z.B. über Github Fragen beantworten. Das hätte den Vorteil, dass ich weiterhin den aktuellen Stand pullen und bei Bedarf schnell einspringen könnte. Es wird aktuell - wie auch die selbstgeschriebenen Plugins - mit dem Plugin WPPusher direkt aus Github in Wordpress eingebunden (Push to master => deploy).


## Features
Im Folgenden eine Liste der wichtigeren Features des Themes. Weiter unten gehe ich auf die einzelnen Punkte ein.

1. Preisträgereinzelseiten und Preisträgerlisten für Journalisten des Jahres und Top30 mit *Laterpay-Paywall*
2. Preisträger-Slider und weitere Shortcodes
3. Homepage Builder (inkl. vorbereitete Anzeigen-Einbindung)
4. Ausgabenseiten


### 1. Preisträgereinzelseiten und Preisträgerlisten
* Es gibt den Post Type `preistraeger`, der in der `./functions.php` mit `add_post_type_preistraeger` deklariert wird.
* Das Template für Preisträger-Einzelseiten basiert auf den folgenden Dateien:
  * `./single-preistraeger` checkt ob es sich um einen Preisträger von JDJ oder Top30, um kleine Informationsunterschiede anzuzeigen (z.B. bei JDJ 1.-10. Platz in den Karten der übrigen in der Kategorie ausgezeichneten Preisträger). Vor Laterpay wurden die Preisträger mit einem Passwort geschützt, das im Heft stand. [Diese Funktionalität](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/template-parts/content-preistraeger.php#L97) ist im Grunde noch vorhanden.
  * `template-parts/content-preistraeger.php` wenn der Nutzer keinen Laterpay-Access gekauft hat, was über die Funktion `LaterPay_Helper_Post::has_access_to_post`aus dem Laterpay-Plugin geprüft wird, wird ihm nur der Teaser angezeigt und dann das Template (`*-noaccess`) eingebunden. Ansonsten werden die Infos angezeigt, die im Backend über das Formular für jeden Preisträger eingetragen wurden. Name, Funktion, Kategorie des Preises und Platz, Twitter, Website, ggf. Post-Thumbnail oder Platzhalterbild (`./images/jdjschwarzaufweiss.png`), Bergündung...
  * `template-parts/content-preistraeger-noaccess.php` - Vorgabe war, dass der Nutzer den Zugang für alle Preisträger auf einmal kauft. Deshalb musste ich das Plugin sehr individuell nutzen und auf der Preisträger-Einzelseite checken, ob der Nutzer Zugriff auf die übergeordnete Übersichtsseite hat. Die Funktion [mmbeta_get_laterpay_purchase_link](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/functions.php#L582) ist natürlich sehr abhängig vom Laterpay-Plugin und keine offizielle API. *Nach einem Laterpay-Update sollte die Funktionalität der Paywall deshalb überprüft werden*
* Die Preisträgerlisten und Auszeichnungen basieren auf der [Custom Taxonomy "Preise"](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/functions.php#L244). Die Funktionen `mmbeta_die_preiskategorie`, `mmbeta_die_preiskategorie_object`, `mmbeta_welcher_preis`, können genutzt werden, um festzustellen, ob es sich gerade um JDJ oder Top30 handelt und um welche Kategorie es sich handelt. `mmbeta_welches_preis_jahr` gibt das Jahr zurück. Die Funktionen haben sich bewährt funktionieren aber nur, wenn die Preisträger gewissenhaft kategorisiert werden.
* Preisträgerlisten basieren auf dem [Template](https://github.com/mmbeta/mmbeta/blob/master/page-templates/template-preistraeger-liste.php) `./page-templates/template-preistrager-liste.php`. Beispiel: https://www.mediummagazin.de/jdj2018-die-preistraeger-innen/ - die automatisch entstehenden Taxonomy-Pages sind eher ein Relikt und sollten besser weitergeleitet oder abgeschaltet werden (TODO).

### 2. Preisträger-Slider und Shortcodes
Hauptanwendungsfall ist die Homepage. [Der Shortcode](https://github.com/mmbeta/mmbeta/blob/master/inc/shortcodes.php) `[heads-gallery]` kann aber auch in Artikeln genutzt werden. In `./inc/shortcodes.php` finden sich auch die anderen Shortcodes (z.B. pdf, show-more, iframe, showcases, galleries)

### 3. Homepage Builder
Die Homepage basiert auf einem Flexible Content Field des Plugins Adveanced Custom Fields Pro. Wie die meisten anderen Custom Fields wird [das Feld](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/inc/custom-fields.php#L243) in `./inc/custom-fields.php` deklariert. Im Page Template [template_home](https://github.com/mmbeta/mmbeta/blob/master/page-templates/template_home.php) gibt es folgende Blöcke, die in folgenden Files näher beschrieben sind:
* [Aufmacher](https://github.com/mmbeta/mmbeta/blob/master/hp/hp-aufmacher.php)
* [Ads](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/page-templates/template_home.php#L88) Man kann im HP Builder für Teasergruppe 1/2/3 (vollbreit => 970 x 250, halb => 336 x 280 LargeRec, ein Drittel => 300 x 250 MedRec) auch das Layout "Ad" wählen. Dann wird der Code aus den Dateien `./hp/hp-teasergruppe-*-ad` eingebunden, in denen sich derzeit nur Dummy-Anzeigen wie https://placeimg.com/970/250/any befinden. Wenn der Beispiel-Code durch echte Ad-Tags ersetzt wird, lassen sich Ads so sehr einfach flexibel auf der Homepage verteilen.
* Teasergruppe `./hp/hp-teasergruppe-*`
* Zitat `./hp/hp-zitat`
* Social `./hp/hp-social` (Twitter und Facebook-Posts - setzt Plugin mmbeta-social voraus)
* Preisträger Slider `./page-templates/template_home.php`
* Video `./hp/hp-video`
* Preisträger-Slider `./page-templates/template_home.php`
* Heft-Slider `./page-templates/template_home.php`


### 4. Ausgabenseiten
Zum Beispiel https://www.mediummagazin.de/medium-magazin-072018/ - Der Kopfbereich mit Cover und drei Themen kann über Custom Fields am Beitrag eingetragen werden, wenn der Beitrag der Kategorie "Ausgaben" zugeordnet wurde. Diese Informationen werden auch auf der Homepage angezeigt, wenn so ein Beitrag als Aufmacher konfiguriert wird.

* mehr-Button - Der Shortcode `[more]Text[/more]` klappt den Text zwischen den Tags ein und wieder aus, wenn der Nutzer drauf klickt.
* PDF-Vorschau - PDFs können mit [dem Shortcode](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/inc/shortcodes.php#L619) `[pdf url="URL-des-PDF" /]` eingebunden werden. Dabei wird der Google Drive PDF Previewer genutzt.
* Für die Inhaltsvorschau und Heft-Kaufen-Links gibt es den alten Shortcode, der ein Bild voraussetzt `[mmshowcase]` und den neuen, der die Links (auch zu einem PDF des Inhaltsverzeichnisses) in einer Liste darstellt `[mmshowcase-list]`.
* Wenn ein Youtube-Video oder Ähnliches eingebunden werden soll, empfiehlt sich der Shortcode `[iframe]https://www.youtube.com/embed/kIAVTd3jVe8[/iframe]`, weil dieser die responsiven Styles für das Video bereitstellt.

*Gutenberg:* Im Gutenberg-Editor funktioniert die Themenübersicht und mit dem Plugin mm-blocks auch die extra dafür geschriebenen Blöcke "MM Teaser" und "MM Showcase". Sie machen das Layouten der Seiten deutlich einfacher. Es gäbe aber gerade was Bildergalerien, Einzelbilder und den Mehr-Auslapp-Button angeht noch ToDos, um mit dem im Classic Editor vorhandenen Funktionsumfang auf Gutenberg umzusteigen. Youtube-Einbindungen etc. funktionieren im Gutenberg sehr viel einfacher out of the box.



## Required Plugins
* [advanced-custom-fields-pro](https://www.advancedcustomfields.com/pro/)
* [Laterpay](https://de.wordpress.org/plugins/laterpay/) Paywall
* [Shortpixel](https://de.wordpress.org/plugins/shortpixel-image-optimiser/) (optional für Bildkompression)
* [mmbeta-owl-carousel](https://github.com/mmbeta/mmbeta-owl-carousel) (für Preisträger-Slider, Heft-Slider und die [Galerien](https://github.com/mmbeta/mmbeta/blob/c378736ef010a072fb9270b4c7ea34fda4736b26/inc/shortcodes.php#L9) die per Shortcode auf Posts genutzt werden können)
* [mmbeta-social](https://github.com/mmbeta/mmbeta-social)
* [mm-blocks](https://github.com/mmbeta/mm-blocks)
* [wordpress-custom-fields-permalinks](https://github.com/athlan/wordpress-custom-fields-permalink-plugin) für (fast) REST-like URLs für Preisträger. Setting: "/%field_preis-name%/%field_preis-jahr%/%postname%/"
* [custom-post-type-permalinks](https://de.wordpress.org/plugins/custom-post-type-permalinks/)
* [wppusher](https://wppusher.com/) Deployment per Commit


## Design
* By David Lichtenberger
* Based on Bootstrap 4


