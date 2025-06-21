from googletrans import Translator

new_keys = {
    'welcome_to': 'Welcome to',
    'enter_world_epic': 'Enter a world of epic battles, mythical creatures, and legendary adventures',
    'join_the_battle': 'Join the Battle',
    'download_now': 'Download Now',
    'server_statistics': 'Server Statistics',
    'players_online': 'Players Online',
    'active_guilds': 'Active Guilds',
    'server_uptime': 'Server Uptime',
    'monsters_slain': 'Monsters Slain',
    'latest_news_events': 'Latest News & Events',
    'view_all': 'View All',
    'by': 'By',
    'read_more': 'Read More',
    'game_features': 'Game Features',
    'pvp_combat': 'PVP Combat',
    'challenge_other_players': 'Challenge other players in epic battles and climb the PVP rankings to earn glory and rewards.',
    'guild_system': 'Guild System',
    'form_powerful_alliances': 'Form powerful alliances, conquer territories, and participate in massive guild wars.',
    'item_crafting': 'Item Crafting',
    'discover_rare_materials': "Discover rare materials and craft legendary equipment to enhance your character's power.",
    'game_screenshots': 'Game Screenshots',
    'view_gallery': 'View Gallery',
    'comments': 'Comments',
    'submit': 'Submit',
    'your_name': 'Your name',
    'title': 'Title',
    'message': 'Message',
    'create_ticket': 'Create Ticket',
    'tickets': 'Tickets',
    'my_tickets': 'My Tickets',
    'new_ticket': 'New Ticket',
    'view_ticket': 'View Ticket',
    'status': 'Status',
    'posted_by': 'Posted by:',
    'news': 'News'
}

translator = Translator()
langs = ['ro','de','fr','tr']
translations = {lang:{} for lang in langs}

for key, text in new_keys.items():
    for lang in langs:
        try:
            translations[lang][key] = translator.translate(text, src='en', dest=lang).text
        except Exception:
            translations[lang][key] = text

for lang in langs:
    path = f'resources/lang/{lang}/messages.php'
    with open(path, 'a', encoding='utf-8') as f:
        for k in new_keys:
            f.write(f"    '{k}' => '{translations[lang][k]}',\n")
print('done')
