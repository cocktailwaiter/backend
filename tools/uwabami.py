from bs4 import BeautifulSoup
import json
import re
import requests
import urllib.request
import urllib.error
import urllib.parse


def wiki_cocktail_page_collect():
    """ sucking cocktail page for Wikipedia """

    # wiki page of cocktail categories
    wiki_cocktail_category_page_list = [
        'https://ja.wikipedia.org/wiki/Category:カクテル',
        'https://ja.wikipedia.org/wiki/Category:ウイスキーベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ウォッカベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ジンベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:テキーラベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ビールベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ブランデーベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ラムベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:リキュールベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ワインベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:シャンパンを使用するカクテル',
        'https://ja.wikipedia.org/wiki/Category:焼酎ベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:日本酒ベースのカクテル',
        'https://ja.wikipedia.org/wiki/Category:ベルモットを使用するカクテル',
        'https://ja.wikipedia.org/wiki/Category:ノンアルコールカクテル'
    ]

    wiki_cocktail_page_list = []

    for cocktail_category_url in wiki_cocktail_category_page_list:
        encoded_url = urllib.parse.quote(cocktail_category_url, safe='/:')
        res = requests.get(encoded_url)
        res.raise_for_status()

        soup = BeautifulSoup(res.text, "html.parser")

        a_tags = soup.select('a[href^="/wiki/"]')

        for a_tag in a_tags:
            cocktail_wiki_url = 'https://ja.wikipedia.org/{url}'.format(
                url=a_tag.get('href'))

            wiki_cocktail_page_list.append(cocktail_wiki_url)

    return wiki_cocktail_page_list


""" Lets collecting cocktail information """
cocktail_wiki_urls = wiki_cocktail_page_collect()

cocktail_infos = []
for url in cocktail_wiki_urls:
    try:
        # acquiring HTML code
        html = urllib.request.urlopen(url)
    except:
        continue

    soup = BeautifulSoup(html, 'html.parser')

    # acquiring infobox class by HTML
    infobox = soup.findAll(class_='infobox')

    if not infobox:
        continue
    infobox = infobox[0].tbody

    cocktail_name = infobox.tr.th.text

    # acquiring cocktail information with itemprop
    itemprops = infobox.findAll('tr', {'itemprop': True})

    tags = []
    for itemprop in itemprops:
        # exclude for empty itemprop
        if (itemprop.th is not None) and (itemprop.td is not None):
            tag_category_name = (itemprop.th.text).strip('\n').lstrip()
            tag_name = (itemprop.td.text).strip('\n').lstrip()

            tag_category_name = re.sub(r'\[[0-9]\]', "", tag_category_name)
            tag_name = re.sub(r'\[[0-9]\]', "", tag_name)

            # exclude for empty itemprop
            if (tag_category_name != '') and (tag_name != ''):
                # add to tag-information to dict object
                tags.append({
                    'category_name': tag_category_name,
                    'name': tag_name
                })

    # add to all-cocktail-information to cocktail-information
    cocktail_infos.append({
        'cocktail_name': cocktail_name,
        'tags': tags
    })

# output the JSON on `cocktail_tag.json`
with open('cocktail_tag.json', 'w') as file:
    json.dump(cocktail_infos, file)

# shorikensu wo shuturyoku suru yo
print(len(cocktail_infos))
