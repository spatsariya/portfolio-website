<?php
/**
 * Editorial annotation overlays for original project screenshots.
 *
 * Framer screenshots are the underlying product screens; explanatory
 * annotations are separate, responsive HTML so they remain readable.
 * All annotation copy is newly written from the published project description.
 * This is collaborative product work, not a record of individual ownership.
 */
return [
    'flipkart-video' => [
        2 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Featured hero', 'description' => 'The first card introduces major releases and newly available titles.', 'top' => 13],
                ['title' => 'Curated collections', 'description' => 'Featured movies provide a quick path into paid and promoted content.', 'top' => 27],
            ],
            'right' => [
                ['title' => 'Navigation tabs', 'description' => 'Viewers can move between Home, Originals, Movies and TV.', 'top' => 4],
                ['title' => 'Autoplay promotion', 'description' => 'Recently launched shows gain visibility through a moving preview.', 'top' => 57],
                ['title' => 'Browse by language', 'description' => 'Regional collections help audiences discover relevant entertainment.', 'top' => 75],
            ],
        ],
        3 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Show artwork', 'description' => 'Large posters make the selected program immediately recognizable.', 'top' => 15],
                ['title' => 'Watchlist', 'description' => 'A favorite action lets viewers return to a title later.', 'top' => 39],
            ],
            'right' => [
                ['title' => 'Season switcher', 'description' => 'An accessible dropdown opens other seasons of a series.', 'top' => 54],
                ['title' => 'Related viewing', 'description' => 'Recommendations keep discovery moving beyond one title.', 'top' => 79],
            ],
        ],
        4 => [
            'mode' => 'gallery',
            'title' => 'Player components and controls',
            'intro' => 'Three related states show how the player supports watching, changing audio or captions, and moving between episodes.',
            'labels' => [
                ['title' => 'Video player', 'description' => 'Playback interface and visible controls.'],
                ['title' => 'Audio and subtitles', 'description' => 'Language and caption preferences on the viewing surface.'],
                ['title' => 'Episode selection', 'description' => 'Navigate the current series without leaving playback.'],
            ],
        ],
        5 => [
            'mode' => 'gallery',
            'title' => 'Advertising within the viewing experience',
            'intro' => 'Video advertisements and branded overlays preserve the relationship between promotion and content.',
            'labels' => [
                ['title' => 'Video advertisement', 'description' => 'Dedicated playback treatment for paid content.'],
                ['title' => 'Brand overlay', 'description' => 'Subtle promotional information layered over an active video.'],
            ],
        ],
    ],
    '2gud' => [
        5 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Browse with search', 'description' => 'Search remains available when a shopper has a specific item in mind.', 'top' => 10],
                ['title' => 'Immersive video', 'description' => 'Full-screen creator content gives products more real-life context.', 'top' => 42],
            ],
            'right' => [
                ['title' => 'Creator discovery', 'description' => 'Follow people you know or explore relevant new creators.', 'top' => 9],
                ['title' => 'Shoppable products', 'description' => 'Item cards relate directly to what appears in the video.', 'top' => 58],
                ['title' => 'Creator storefront', 'description' => 'A profile shortcut leads to more recommendations and collections.', 'top' => 83],
            ],
            'extrasTitle' => 'Product discovery in the video',
            'extrasIntro' => 'Additional states demonstrate how shoppers open the products shown by a creator without losing the surrounding discovery experience.',
        ],
        6 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Merchandising hero', 'description' => 'A promotional section connects products and creators on the same page.', 'top' => 10],
                ['title' => 'Popular creators', 'description' => 'Trending profiles open another path into product discovery.', 'top' => 35],
                ['title' => 'Shop by budget', 'description' => 'Simple price-based entry points retain the utility of ordinary shopping.', 'top' => 82],
            ],
            'right' => [
                ['title' => 'Creator collections', 'description' => 'Recommended products are grouped into approachable, aspirational sets.', 'top' => 53],
                ['title' => 'Deals and offers', 'description' => 'Price-led cards provide quick access to value shopping.', 'top' => 76],
            ],
        ],
        7 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Creator identity', 'description' => 'The store is organized around a recognizable voice and style.', 'top' => 14],
                ['title' => 'Recommended products', 'description' => 'Collections show the items highlighted in creator content.', 'top' => 57],
            ],
            'right' => [
                ['title' => 'Storefront navigation', 'description' => 'Shoppers can move through curated selections and offers.', 'top' => 28],
                ['title' => 'Shop the collection', 'description' => 'Direct entry to individual products keeps the journey actionable.', 'top' => 79],
            ],
        ],
    ],
    'supercoin' => [
        5 => [
            'mode' => 'annotated',
            'screen' => 0,
            'left' => [
                ['title' => 'Campaign headline', 'description' => 'The promotional hero makes high-value rewards visible immediately.', 'top' => 8],
                ['title' => 'Popular redemptions', 'description' => 'Commonly selected rewards reduce the time needed to choose.', 'top' => 39],
                ['title' => 'Earn through content', 'description' => 'Video-based activities offer another way to collect coins.', 'top' => 74],
            ],
            'right' => [
                ['title' => 'Quick navigation', 'description' => 'Icons connect rewards, balances, earning paths and history.', 'top' => 11],
                ['title' => 'Coins plus payment', 'description' => 'More rewards become attainable even with a smaller coin balance.', 'top' => 53],
                ['title' => 'Play to earn', 'description' => 'Game participation is linked to rewards within the platform.', 'top' => 83],
            ],
        ],
        6 => [
            'mode' => 'gallery',
            'title' => 'Relevant rewards by coin balance',
            'intro' => 'Three user cohorts see different reward suggestions while retaining access to other offers through cash-plus-coins redemption.',
            'labels' => [
                ['title' => 'Below 500 coins', 'description' => 'Accessible redemptions appear first.'],
                ['title' => '500–1,000 coins', 'description' => 'A tailored selection of mid-tier offers.'],
                ['title' => 'Above 1,000 coins', 'description' => 'Higher-value rewards gain prominence.'],
            ],
        ],
        7 => [
            'mode' => 'gallery',
            'title' => 'Make the balance useful',
            'intro' => 'A customer can combine earned coins with cash instead of waiting indefinitely for an expensive reward.',
            'labels' => [
                ['title' => 'Cash + Coins', 'description' => 'The purchase action displays the balance and remaining payment.'],
                ['title' => 'Coin information', 'description' => 'Balance details clarify how rewards can be used.'],
            ],
        ],
        8 => [
            'mode' => 'gallery',
            'title' => 'Rewards grouped by purpose',
            'intro' => 'Condensed reward cards, a daily offer, and category groupings improve scanning across entertainment, shopping and food.',
            'labels' => [
                ['title' => 'Rewards overview', 'description' => 'Multiple offers fit in one scroll, with a featured daily deal.'],
                ['title' => 'Entertainment', 'description' => 'Relevant media and streaming rewards together.'],
                ['title' => 'Shopping', 'description' => 'Store and merchandise rewards grouped for browsing.'],
                ['title' => 'Food', 'description' => 'Food and dining offers grouped in their own category.'],
            ],
        ],
    ],
];
