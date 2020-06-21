---
layout: default
---

| Title | Link To | URLs |
|------|---------|------|
{% assign redirects = site.pages | where_exp: "item", "item.redirect_to != nil" %}
{% for page in redirects %}
|<strong>{{ page.title | escape }}</strong>|`{{ page.redirect_to }}` |[{{ page.url }}]({{ page.url | relative_url }})|

---
{% endfor %}
