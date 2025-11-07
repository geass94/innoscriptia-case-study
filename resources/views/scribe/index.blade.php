<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost:8002";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.5.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.5.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-articles" class="tocify-header">
                <li class="tocify-item level-1" data-unique="articles">
                    <a href="#articles">Articles</a>
                </li>
                                    <ul id="tocify-subheader-articles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="articles-GETapi-v1-articles">
                                <a href="#articles-GETapi-v1-articles">List articles</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="articles-GETapi-v1-articles--id-">
                                <a href="#articles-GETapi-v1-articles--id-">Get a single article</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="articles-POSTapi-v1-articles-preferences">
                                <a href="#articles-POSTapi-v1-articles-preferences">Get personalized articles</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-filter-options" class="tocify-header">
                <li class="tocify-item level-1" data-unique="filter-options">
                    <a href="#filter-options">Filter Options</a>
                </li>
                                    <ul id="tocify-subheader-filter-options" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="filter-options-GETapi-v1-sources">
                                <a href="#filter-options-GETapi-v1-sources">Get available sources</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="filter-options-GETapi-v1-categories">
                                <a href="#filter-options-GETapi-v1-categories">Get available categories</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="filter-options-GETapi-v1-authors">
                                <a href="#filter-options-GETapi-v1-authors">Get available authors</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: November 7, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>A comprehensive news aggregation API that collects articles from multiple sources including NewsAPI, The Guardian, and NY Times. Search, filter, and personalize your news feed.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost:8002</code>
</aside>
<pre><code>This API provides access to aggregated news articles from multiple trusted sources. You can search, filter, and retrieve articles based on various criteria such as keywords, sources, categories, authors, and date ranges.

## Key Features
- **Multi-source aggregation**: Articles from NewsAPI, The Guardian, and NY Times
- **Advanced filtering**: Filter by keyword, source, category, author, and date range
- **Personalization**: Set preferences for sources, categories, and authors
- **Pagination &amp; sorting**: Efficiently browse through articles with customizable pagination
- **RESTful design**: Simple, intuitive endpoints following REST principles

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="articles">Articles</h1>

    

                                <h2 id="articles-GETapi-v1-articles">List articles</h2>

<p>
</p>

<p>Retrieve a paginated list of articles with optional filtering and sorting.</p>

<span id="example-requests-GETapi-v1-articles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8002/api/v1/articles?page=1&amp;per_page=15&amp;sort=-published_at&amp;filter%5Bkeyword%5D=technology&amp;filter%5Bsource%5D=NewsAPI&amp;filter%5Bsources%5D%5B%5D=&amp;filter%5Bcategory%5D=business&amp;filter%5Bcategories%5D%5B%5D=&amp;filter%5Bauthor%5D=John+Doe&amp;filter%5Bauthors%5D%5B%5D=&amp;filter%5Bdate_range%5D%5Bfrom%5D=2024-01-01&amp;filter%5Bdate_range%5D%5Bto%5D=2024-12-31" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"filter\": {
        \"keyword\": \"b\",
        \"source\": \"NY Times\",
        \"sources\": [
            \"The Guardian\"
        ],
        \"category\": \"n\",
        \"categories\": [
            \"g\"
        ],
        \"author\": \"z\",
        \"authors\": [
            \"m\"
        ],
        \"date_range\": {
            \"from\": \"2025-11-07T12:20:21\",
            \"to\": \"2025-11-07T12:20:21\"
        }
    },
    \"page\": 35,
    \"per_page\": 8,
    \"sort\": \"published_at\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/articles"
);

const params = {
    "page": "1",
    "per_page": "15",
    "sort": "-published_at",
    "filter[keyword]": "technology",
    "filter[source]": "NewsAPI",
    "filter[sources][]": "",
    "filter[category]": "business",
    "filter[categories][]": "",
    "filter[author]": "John Doe",
    "filter[authors][]": "",
    "filter[date_range][from]": "2024-01-01",
    "filter[date_range][to]": "2024-12-31",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "filter": {
        "keyword": "b",
        "source": "NY Times",
        "sources": [
            "The Guardian"
        ],
        "category": "n",
        "categories": [
            "g"
        ],
        "author": "z",
        "authors": [
            "m"
        ],
        "date_range": {
            "from": "2025-11-07T12:20:21",
            "to": "2025-11-07T12:20:21"
        }
    },
    "page": 35,
    "per_page": 8,
    "sort": "published_at"
};

fetch(url, {
    method: "GET",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-articles">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;externalId&quot;: &quot;abc123&quot;,
            &quot;source&quot;: &quot;NewsAPI&quot;,
            &quot;title&quot;: &quot;Breaking News: Tech Innovation&quot;,
            &quot;description&quot;: &quot;A comprehensive look at the latest tech innovations&quot;,
            &quot;content&quot;: &quot;Full article content here...&quot;,
            &quot;url&quot;: &quot;https://example.com/article&quot;,
            &quot;imageUrl&quot;: &quot;https://example.com/image.jpg&quot;,
            &quot;author&quot;: &quot;John Doe&quot;,
            &quot;category&quot;: &quot;technology&quot;,
            &quot;publishedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
            &quot;contentHash&quot;: &quot;hash123&quot;,
            &quot;createdAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
            &quot;updatedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 10,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 15,
        &quot;total&quot;: 150
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-articles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-articles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-articles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-articles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-articles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-articles" data-method="GET"
      data-path="api/v1/articles"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-articles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-articles"
                    onclick="tryItOut('GETapi-v1-articles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-articles"
                    onclick="cancelTryOut('GETapi-v1-articles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-articles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/articles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-articles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-articles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-articles"
               value="1"
               data-component="query">
    <br>
<p>Page number for pagination. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-articles"
               value="15"
               data-component="query">
    <br>
<p>Number of items per page (1-100). Example: <code>15</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-v1-articles"
               value="-published_at"
               data-component="query">
    <br>
<p>Sort field and direction. Prefix with - for descending. Example: <code>-published_at</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[keyword]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[keyword]"                data-endpoint="GETapi-v1-articles"
               value="technology"
               data-component="query">
    <br>
<p>Search keyword in title, description, and content. Example: <code>technology</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[source]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[source]"                data-endpoint="GETapi-v1-articles"
               value="NewsAPI"
               data-component="query">
    <br>
<p>Filter by a single source. Example: <code>NewsAPI</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[sources][]</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[sources].0[0]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
        <input type="text" style="display: none"
               name="filter[sources].0[1]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
    <br>
<p>Filter by multiple sources.</p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[category]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[category]"                data-endpoint="GETapi-v1-articles"
               value="business"
               data-component="query">
    <br>
<p>Filter by a single category. Example: <code>business</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[categories][]</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[categories].0[0]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
        <input type="text" style="display: none"
               name="filter[categories].0[1]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
    <br>
<p>Filter by multiple categories.</p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[author]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[author]"                data-endpoint="GETapi-v1-articles"
               value="John Doe"
               data-component="query">
    <br>
<p>Filter by a single author name. Example: <code>John Doe</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[authors][]</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[authors].0[0]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
        <input type="text" style="display: none"
               name="filter[authors].0[1]"                data-endpoint="GETapi-v1-articles"
               data-component="query">
    <br>
<p>Filter by multiple authors.</p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[date_range][from]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[date_range][from]"                data-endpoint="GETapi-v1-articles"
               value="2024-01-01"
               data-component="query">
    <br>
<p>Filter articles from this date (Y-m-d format). Example: <code>2024-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>filter[date_range][to]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[date_range][to]"                data-endpoint="GETapi-v1-articles"
               value="2024-12-31"
               data-component="query">
    <br>
<p>Filter articles to this date (Y-m-d format). Example: <code>2024-12-31</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>filter</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>keyword</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.keyword"                data-endpoint="GETapi-v1-articles"
               value="b"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>b</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>source</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.source"                data-endpoint="GETapi-v1-articles"
               value="NY Times"
               data-component="body">
    <br>
<p>Example: <code>NY Times</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>NewsAPI</code></li> <li><code>The Guardian</code></li> <li><code>NY Times</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>sources</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.sources[0]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
        <input type="text" style="display: none"
               name="filter.sources[1]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
    <br>

Must be one of:
<ul style="list-style-type: square;"><li><code>NewsAPI</code></li> <li><code>The Guardian</code></li> <li><code>NY Times</code></li></ul>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>category</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.category"                data-endpoint="GETapi-v1-articles"
               value="n"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters. Example: <code>n</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>categories</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.categories[0]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
        <input type="text" style="display: none"
               name="filter.categories[1]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
    <br>
<p>Must not be greater than 100 characters.</p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>author</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.author"                data-endpoint="GETapi-v1-articles"
               value="z"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>z</code></p>
                    </div>
                                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>authors</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.authors[0]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
        <input type="text" style="display: none"
               name="filter.authors[1]"                data-endpoint="GETapi-v1-articles"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters.</p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>date_range</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.date_range.from"                data-endpoint="GETapi-v1-articles"
               value="2025-11-07T12:20:21"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-11-07T12:20:21</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.date_range.to"                data-endpoint="GETapi-v1-articles"
               value="2025-11-07T12:20:21"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-11-07T12:20:21</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="GETapi-v1-articles"
               value="35"
               data-component="body">
    <br>
<p>Must be at least 1. Example: <code>35</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-v1-articles"
               value="8"
               data-component="body">
    <br>
<p>Must be at least 1. Must not be greater than 100. Example: <code>8</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-v1-articles"
               value="published_at"
               data-component="body">
    <br>
<p>Example: <code>published_at</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>published_at</code></li> <li><code>-published_at</code></li> <li><code>created_at</code></li> <li><code>-created_at</code></li> <li><code>title</code></li> <li><code>-title</code></li></ul>
        </div>
        </form>

                    <h2 id="articles-GETapi-v1-articles--id-">Get a single article</h2>

<p>
</p>

<p>Retrieve detailed information about a specific article by its ID.</p>

<span id="example-requests-GETapi-v1-articles--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8002/api/v1/articles/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/articles/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-articles--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;externalId&quot;: &quot;abc123&quot;,
    &quot;source&quot;: &quot;NewsAPI&quot;,
    &quot;title&quot;: &quot;Breaking News: Tech Innovation&quot;,
    &quot;description&quot;: &quot;A comprehensive look at the latest tech innovations&quot;,
    &quot;content&quot;: &quot;Full article content here...&quot;,
    &quot;url&quot;: &quot;https://example.com/article&quot;,
    &quot;imageUrl&quot;: &quot;https://example.com/image.jpg&quot;,
    &quot;author&quot;: &quot;John Doe&quot;,
    &quot;category&quot;: &quot;technology&quot;,
    &quot;publishedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
    &quot;contentHash&quot;: &quot;hash123&quot;,
    &quot;createdAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
    &quot;updatedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Article not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-articles--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-articles--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-articles--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-articles--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-articles--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-articles--id-" data-method="GET"
      data-path="api/v1/articles/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-articles--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-articles--id-"
                    onclick="tryItOut('GETapi-v1-articles--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-articles--id-"
                    onclick="cancelTryOut('GETapi-v1-articles--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-articles--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/articles/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-articles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-articles--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-v1-articles--id-"
               value="1"
               data-component="url">
    <br>
<p>The article ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="articles-POSTapi-v1-articles-preferences">Get personalized articles</h2>

<p>
</p>

<p>Retrieve articles filtered by user preferences. This endpoint allows you to fetch
articles based on preferred sources, categories, and authors, with additional
keyword and date range filtering capabilities.</p>

<span id="example-requests-POSTapi-v1-articles-preferences">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost:8002/api/v1/articles/preferences" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"preferred_sources\": [
        \"NewsAPI\",
        \"The Guardian\"
    ],
    \"preferred_categories\": [
        \"technology\",
        \"business\"
    ],
    \"preferred_authors\": [
        \"John Doe\",
        \"Jane Smith\"
    ],
    \"filter\": {
        \"keyword\": \"g\",
        \"date_range\": {
            \"from\": \"2025-11-07T12:20:21\",
            \"to\": \"2025-11-07T12:20:21\"
        }
    },
    \"page\": 1,
    \"per_page\": 15,
    \"filter[keyword]\": \"innovation\",
    \"filter[date_range][from]\": \"2024-01-01\",
    \"filter[date_range][to]\": \"2024-12-31\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/articles/preferences"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "preferred_sources": [
        "NewsAPI",
        "The Guardian"
    ],
    "preferred_categories": [
        "technology",
        "business"
    ],
    "preferred_authors": [
        "John Doe",
        "Jane Smith"
    ],
    "filter": {
        "keyword": "g",
        "date_range": {
            "from": "2025-11-07T12:20:21",
            "to": "2025-11-07T12:20:21"
        }
    },
    "page": 1,
    "per_page": 15,
    "filter[keyword]": "innovation",
    "filter[date_range][from]": "2024-01-01",
    "filter[date_range][to]": "2024-12-31"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-v1-articles-preferences">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;externalId&quot;: &quot;abc123&quot;,
            &quot;source&quot;: &quot;NewsAPI&quot;,
            &quot;title&quot;: &quot;Breaking News: Tech Innovation&quot;,
            &quot;description&quot;: &quot;A comprehensive look at the latest tech innovations&quot;,
            &quot;content&quot;: &quot;Full article content here...&quot;,
            &quot;url&quot;: &quot;https://example.com/article&quot;,
            &quot;imageUrl&quot;: &quot;https://example.com/image.jpg&quot;,
            &quot;author&quot;: &quot;John Doe&quot;,
            &quot;category&quot;: &quot;technology&quot;,
            &quot;publishedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
            &quot;contentHash&quot;: &quot;hash123&quot;,
            &quot;createdAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;,
            &quot;updatedAt&quot;: &quot;2024-01-15T10:30:00.000Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;from&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;per_page&quot;: 15,
        &quot;to&quot;: 15,
        &quot;total&quot;: 75
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-v1-articles-preferences" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-v1-articles-preferences"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-articles-preferences"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-v1-articles-preferences" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-articles-preferences">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-v1-articles-preferences" data-method="POST"
      data-path="api/v1/articles/preferences"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-articles-preferences', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-v1-articles-preferences"
                    onclick="tryItOut('POSTapi-v1-articles-preferences');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-v1-articles-preferences"
                    onclick="cancelTryOut('POSTapi-v1-articles-preferences');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-v1-articles-preferences"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/v1/articles/preferences</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-v1-articles-preferences"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-v1-articles-preferences"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>preferred_sources</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="preferred_sources[0]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
        <input type="text" style="display: none"
               name="preferred_sources[1]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
    <br>
<p>Array of preferred news sources.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>preferred_categories</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="preferred_categories[0]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
        <input type="text" style="display: none"
               name="preferred_categories[1]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
    <br>
<p>Array of preferred categories.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>preferred_authors</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="preferred_authors[0]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
        <input type="text" style="display: none"
               name="preferred_authors[1]"                data-endpoint="POSTapi-v1-articles-preferences"
               data-component="body">
    <br>
<p>Array of preferred authors.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>filter</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 14px; clear: unset;">
                        <b style="line-height: 2;"><code>keyword</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.keyword"                data-endpoint="POSTapi-v1-articles-preferences"
               value="g"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>g</code></p>
                    </div>
                                                                <div style=" margin-left: 14px; clear: unset;">
        <details>
            <summary style="padding-bottom: 10px;">
                <b style="line-height: 2;"><code>date_range</code></b>&nbsp;&nbsp;
<small>object</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
<br>

            </summary>
                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>from</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.date_range.from"                data-endpoint="POSTapi-v1-articles-preferences"
               value="2025-11-07T12:20:21"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-11-07T12:20:21</code></p>
                    </div>
                                                                <div style="margin-left: 28px; clear: unset;">
                        <b style="line-height: 2;"><code>to</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter.date_range.to"                data-endpoint="POSTapi-v1-articles-preferences"
               value="2025-11-07T12:20:21"
               data-component="body">
    <br>
<p>Must be a valid date. Example: <code>2025-11-07T12:20:21</code></p>
                    </div>
                                    </details>
        </div>
                                        </details>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="page"                data-endpoint="POSTapi-v1-articles-preferences"
               value="1"
               data-component="body">
    <br>
<p>Page number for pagination. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="POSTapi-v1-articles-preferences"
               value="15"
               data-component="body">
    <br>
<p>Number of items per page (1-100). Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>filter[keyword]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[keyword]"                data-endpoint="POSTapi-v1-articles-preferences"
               value="innovation"
               data-component="body">
    <br>
<p>Search keyword in title, description, and content. Example: <code>innovation</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>filter[date_range][from]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[date_range][from]"                data-endpoint="POSTapi-v1-articles-preferences"
               value="2024-01-01"
               data-component="body">
    <br>
<p>Filter articles from this date (Y-m-d format). Example: <code>2024-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>filter[date_range][to]</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="filter[date_range][to]"                data-endpoint="POSTapi-v1-articles-preferences"
               value="2024-12-31"
               data-component="body">
    <br>
<p>Filter articles to this date (Y-m-d format). Example: <code>2024-12-31</code></p>
        </div>
        </form>

                <h1 id="filter-options">Filter Options</h1>

    

                                <h2 id="filter-options-GETapi-v1-sources">Get available sources</h2>

<p>
</p>

<p>Retrieve a list of all distinct news sources available in the system.
This endpoint is useful for populating filter dropdowns.</p>

<span id="example-requests-GETapi-v1-sources">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8002/api/v1/sources" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/sources"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-sources">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        &quot;NewsAPI&quot;,
        &quot;The Guardian&quot;,
        &quot;NY Times&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-sources" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-sources"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-sources"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-sources" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-sources">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-sources" data-method="GET"
      data-path="api/v1/sources"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-sources', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-sources"
                    onclick="tryItOut('GETapi-v1-sources');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-sources"
                    onclick="cancelTryOut('GETapi-v1-sources');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-sources"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/sources</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-sources"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-sources"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="filter-options-GETapi-v1-categories">Get available categories</h2>

<p>
</p>

<p>Retrieve a list of all distinct article categories available in the system.
This endpoint is useful for populating filter dropdowns.</p>

<span id="example-requests-GETapi-v1-categories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8002/api/v1/categories" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/categories"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-categories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        &quot;business&quot;,
        &quot;entertainment&quot;,
        &quot;health&quot;,
        &quot;science&quot;,
        &quot;sports&quot;,
        &quot;technology&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-categories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-categories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-categories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-categories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-categories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-categories" data-method="GET"
      data-path="api/v1/categories"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-categories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-categories"
                    onclick="tryItOut('GETapi-v1-categories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-categories"
                    onclick="cancelTryOut('GETapi-v1-categories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-categories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/categories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-categories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="filter-options-GETapi-v1-authors">Get available authors</h2>

<p>
</p>

<p>Retrieve a list of all distinct article authors available in the system.
This endpoint is useful for populating filter dropdowns.</p>

<span id="example-requests-GETapi-v1-authors">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost:8002/api/v1/authors" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost:8002/api/v1/authors"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-v1-authors">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        &quot;Jane Smith&quot;,
        &quot;John Doe&quot;,
        &quot;Sarah Johnson&quot;
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-v1-authors" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-v1-authors"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-authors"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-v1-authors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-authors">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-v1-authors" data-method="GET"
      data-path="api/v1/authors"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-authors', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-v1-authors"
                    onclick="tryItOut('GETapi-v1-authors');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-v1-authors"
                    onclick="cancelTryOut('GETapi-v1-authors');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-v1-authors"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/v1/authors</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-v1-authors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-v1-authors"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
