<h2>For install module into the your project:</h2>
1. download this module into app/code/ folder of your project
2. run bin/magento setup:uprgade command
3. run bin/magento cache:clean




Using.

Module has three comands with attributes and options:

1. add/update color
scandiweb:color-change <color> <id> <store_code> [--cache]

<color> - colorname or color code with hashtag(use "'")
<id> - DOM element ID
<store_code> - store code of your site. Not requerment attribute
[--cache] - clean config, bloch_html and full page cahe after change

examples: 
scandiweb:color-change yellow switcher-language-trigger --cache 
scandiweb:color-change '#1fd99a' switcher-language-trigger en_US
scandiweb:color-change red switcher-language-trigger an_GB
scandiweb:color-change black switcher1
scandiweb:color-change yellow switcher2


   
2. remove all colors
scandiweb:colors-remove <store_code> [--cache]

<store_code> - store code of your site. Not requerment attribute
[--cache] - clean config, bloch_html and full page cahe after change

examples:
scandiweb:colors-remove en_US [--cache]


3. Show all saved colors and DOM element Ids
scandiweb:colors-show <store_code>

examples:
scandiweb:colors-show

output:
List of id's styles:
1: id=switcher-language-trigger; color=black;
2: id=switcher1; color=yellow;
3: id=switcher3; color=#1fd99a;

