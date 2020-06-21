---
layout: default
---
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Redirects To</th>
            <th>Short Urls</th>
        </tr>
    </thead>
    <tbody>

{% assign redirects = site.pages | where_exp: "item", "item.redirect_to != nil" %}
{% for page in redirects %}
<tr>
<td>**{{ page.title | escape }}**</td>
<td>`{{ page.redirect_to }}`</td> 
<td>
* [{{ page.url }}]({{ page.url | relative_url }})
{% for from in page.redirect_from %} 
* [{{ from }}]({{ from | relative_url }})
{% endfor %} 
</td>
</tr>
{% endfor %}
    </tbody>
</table>

