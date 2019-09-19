<h3>For install module into the your project</h3>
<p>1. download this module into app/code/ folder of your project</p>
<p>2. run bin/magento setup:uprgade command</p>
<p>3. run bin/magento cache:clean</p>




<h3>Instruction for use</h3>
<p>Module has three comands with attributes and options:</p>

<b>1. add/update color<br>
scandiweb:color-change &lt;color&gt; &lt;id&gt; &lt;store_code&gt; [--cache]</b>

<p><b>&lt;color&gt;</b> - colorname or color code with hashtag</p>
<p><b>&lt;id&gt;</b> - DOM element ID</p>
<p><b>&lt;store_code&gt;</b> - store code of your site. Not requerment attribute</p>
<p><b>[--cache]</b> - clean config, bloch_html and full page cahe after change</p>

<i>examples:</i><br>
scandiweb:color-change yellow switcher-language-trigger --cache </br>
scandiweb:color-change '#1fd99a' switcher-language-trigger en_US </br>
scandiweb:color-change red switcher-language-trigger an_GB </br>
scandiweb:color-change black switcher1 </br>
scandiweb:color-change yellow switcher2 </br>


   
<b>2. remove all colors<br>
scandiweb:colors-remove &lt;store_code&gt; [--cache]</b>

<p><b>&lt;store_code&gt;</b> - store code of your site. Not requerment attribute</p>
<p><b>[--cache]</b> - clean config, bloch_html and full page cahe after change</p>

<i>examples:</i>
scandiweb:colors-remove en_US [--cache]<br>


<b>3. Show all saved colors and DOM element Ids<br>
scandiweb:colors-show &lt;store_code&gt;</b>

<i>examples:</i><br>
scandiweb:colors-show<br>

output:<br>
List of id's styles:<br>
1: id=switcher-language-trigger; color=black;<br>
2: id=switcher1; color=yellow;<br>
3: id=switcher3; color=#1fd99a;<br>

