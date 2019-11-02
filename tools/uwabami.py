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
        'https://ja.wikipedia.org/wiki/カクテルの一覧',
        'https://ja.wikipedia.org/wiki/IBA公認カクテルリスト',
        'https://ja.wikipedia.org/wiki/50音順のカクテル一覧',
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

    print('------- Cocktail Category List --------')
    for cocktail_category_url in wiki_cocktail_category_page_list:
        print(cocktail_category_url)

        encoded_url = urllib.parse.quote(cocktail_category_url, safe='/:')
        res = requests.get(encoded_url)
        res.raise_for_status()

        soup = BeautifulSoup(res.text, "html.parser")

        a_tags = soup.select('a[href^="/wiki/"]')

        for a_tag in a_tags:
            cocktail_wiki_url = 'https://ja.wikipedia.org/{url}'.format(
                url=a_tag.get('href'))

            wiki_cocktail_page_list.append(cocktail_wiki_url)
    print('-------------------------')

    wiki_cocktail_page_list = list(set(wiki_cocktail_page_list))
    return wiki_cocktail_page_list


def seikei(string):
    string = string.replace('〜', '-')
    string = re.sub(r'….*', "", string)
    string = re.sub(r'\[.*\]', "", string)
    string = (string.strip('\n')).strip()

    return string

""" Lets collecting cocktail information """
cocktail_wiki_urls = wiki_cocktail_page_collect()

cocktail_infos = []

print('------- try cocktail sucking page --------')
for url in cocktail_wiki_urls:
    decoded_url = urllib.parse.unquote_to_bytes(url).decode()
    print(decoded_url)

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

    if (not infobox) or (not infobox.tr) or (not infobox.tr.th) or (not infobox.tr.th.text):
        continue

    cocktail_name = seikei(infobox.tr.th.text)

    # acquiring cocktail information with itemprop
    itemprops = infobox.findAll('tr', {'itemprop': True})

    tags = []
    for itemprop in itemprops:
        # exclude for empty itemprop
        if (itemprop.th is not None) and (itemprop.td is not None):
            tag_category_name = seikei(itemprop.th.text)
            tag_names = seikei(itemprop.td.text)

            # exclude for empty itemprop
            if (tag_category_name != '') and (tag_names != ''):

                # add to tag-information to dict object
                if tag_category_name == '備考':
                    tag_name = tag_names
                    tags.append({
                        'category_name': tag_category_name,
                        'name': tag_name
                    })
                else:
                    for tag_name in tag_names.split('、'):
                        tags.append({
                            'category_name': tag_category_name,
                            'name': tag_name
                        })

    # add to all-cocktail-information to cocktail-information
    cocktail_infos.append({
        'cocktail_name': cocktail_name,
        'tags': tags
    })
print('------------------------------------------')

# output the JSON on `cocktail_tag.json`
with open('cocktail_tag.json', 'w') as file:
    json.dump(cocktail_infos, file)

# shorikensu wo shuturyoku suru yo
print(len(cocktail_infos))
