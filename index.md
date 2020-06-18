---
layout: default
---

{% assign redirects = site.pages | where_exp: "item", "item.redirect_to != nil" %}
{% for page in redirects %}
  [{{ page.url }}]({{ page.url | relative_url }}) 🔀 `{{ page.redirect_to }}` <small>{{ page.title | escape }}</small>

{% for from in redirect_from %}
  [{{ from.url }}]({{ from.url | relative_url }}) 🔀 `{{ page.redirect_to }}` <small>{{ page.title | escape }}</small>
{% endfor %}
  ---
{% endfor %}
