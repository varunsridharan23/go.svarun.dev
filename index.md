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
<td><strong>{{ page.title | escape }}</strong></td>
<td><code>{{ page.redirect_to }}</code></td> 
<td>
<ul>
    <li><a href="{{ page.url | relative_url }}">{{ page.url }}</a></li>
    {% for from in page.redirect_from %} 
     <li><a href="{{ from | relative_url }}">{{ from }}</a></li>
    {% endfor %} 
</ul>
</td>
</tr>
{% endfor %}
    </tbody>
</table>

