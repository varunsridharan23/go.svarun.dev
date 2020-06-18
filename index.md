---
layout: default
---

{% assign redirects = site.pages | where_exp: "item", "item.redirect_to != nil" %}
{% for page in redirects %}
<strong>{{ page.title | escape }}</strong>
`{{ page.redirect_to }}` 
    <ul>
        <li> 
           [{{ page.url }}]({{ page.url | relative_url }})
        </li>
        <ul>
            {% for from in page.redirect_from %}
             <li> 
                [{{ from }}]({{ from | relative_url }})
            </li> 
            {% endfor %}
        </ul>
    </ul>
  ---
{% endfor %}
