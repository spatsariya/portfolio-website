<?php
/**
 * Curated Flipkart ecosystem project studies.
 * Original wording is new; third-party case-study narratives and metrics are attributed.
 * These are collaborative product efforts, not claims of sole authorship.
 */
return [
    '2gud' => [
        'title' => '2GUD by Flipkart',
        'eyebrow' => 'Commerce / Experience design',
        'headline' => 'Turning value shopping into something worth exploring.',
        'summary' => 'A commerce experience for value-conscious shoppers, connecting affordable discovery with the familiarity and trust of community-led recommendations.',
        'source' => 'https://www.rishivaths.com/2gud',
        'challenge' => 'The marketplace attracted visitors but struggled to turn browsing into engaged shopping and purchases. Price alone did not communicate style, credibility or relevance to customers discovering unfamiliar products.',
        'context' => 'The wider Flipkart team investigated shopping motivations among younger, value-focused consumers, including how people decide whether they can trust products and where they look for inspiration.',
        'discovery' => [
            'Research compared marketplace behaviours with competitors such as AliExpress, Shein, Club Factory and Wish.',
            'The referenced study describes interviews with 18–30-year-old shoppers, empathy mapping and synthesis of experience, functional and aspirational goals.',
            'The direction prioritized aspirational choice, product confidence and more engaging product discovery.'
        ],
        'approach' => [
            ['title' => 'From catalogue to community', 'body' => 'Instead of presenting products as a static grid, the concept connected shopping journeys with relatable creators presenting outfits, accessories and everyday items in use.'],
            ['title' => 'Video-led storefront', 'body' => 'A full-screen shoppable feed placed creator stories alongside linked product cards, profile entry points and a persistent path back to search.'],
            ['title' => 'Explore without losing control', 'body' => 'The proposed merchandising experience retained categories, price-led discovery, deals and product details for shoppers who preferred conventional browsing.'],
            ['title' => 'Make the experience testable', 'body' => 'Interactive prototypes and internal testing were used to evaluate the vision on mobile before comparing it with more traditional marketplace journeys.']
        ],
        'outcome' => 'The referenced case study reports approximately 3× higher conversion following launch, greater engagement in a five-week experiment and roughly 18 minutes of average time spent. These are reported team outcomes, not individually attributed results.',
        'metrics' => [['3×','Reported conversion lift'],['18 min','Reported average time spent'],['2×','DAU figure shown in source']],
        'gallery' => [
            ['url' => 'https://framerusercontent.com/images/PJMaS9RCFgQtn1TITj56Wav6wI.png', 'caption' => 'Shoppable creator-led commerce home', 'alt' => '2GUD influencer-led shopping concept'],
            ['url' => 'https://framerusercontent.com/images/30APGpx2h25FiohqlGHQkiUIas.png', 'caption' => 'Product discovery and video-linked details', 'alt' => '2GUD product discovery interface'],
            ['url' => 'https://framerusercontent.com/images/YzDNRhNPKiCWixYYupn379D70oE.png', 'caption' => 'Merchandising and influencer exploration', 'alt' => '2GUD merchandising exploration interface']
        ],
        'lesson' => 'Value shopping is not only a pricing problem. The experience must build confidence and help customers imagine a product in their own lives.'
    ],
    'supercoin' => [
        'title' => 'Flipkart SuperCoin',
        'eyebrow' => 'Loyalty / Rewards UX',
        'headline' => 'Making rewards feel easier to earn, find and use.',
        'summary' => 'A clearer discovery model for the SuperCoin rewards ecosystem that balances personalization, value visibility and repeat engagement.',
        'source' => 'https://www.rishivaths.com/supercoin',
        'challenge' => 'A rewards category with a reported 52% bounce rate needed to make useful offers easier to discover, especially for customers whose available coins did not match high-cost rewards.',
        'context' => 'The loyalty experience existed inside the Flipkart app, where customers needed to see what they had earned, understand expiry and find rewards that matched their balance.',
        'discovery' => [
            'The source documents ten interviews with existing SuperCoin users.',
            'Feedback pointed to confusing navigation, difficult reward discovery and the perception that redemption required too many coins.',
            'Research was translated into user stories for coin information, redeeming, earning, category filters and contextual offers.'
        ],
        'approach' => [
            ['title' => 'Merchandise the rewards', 'body' => 'The rewards destination was reorganized around an e-commerce-inspired storefront with clearer category navigation, promotional modules and popular rewards.'],
            ['title' => 'Personalize by balance', 'body' => 'Three balance-based cohorts were introduced in the concept: below 500 coins, 500–1,000 coins and above 1,000 coins.'],
            ['title' => 'Remove the redemption dead end', 'body' => 'A combined coins-and-cash purchase path helped make offers approachable even when customers had fewer coins than a reward required.'],
            ['title' => 'Explain the system as people use it', 'body' => 'Onboarding, expiry information, savings cues and opportunities to earn coins through viewing videos and playing games supported ongoing discovery.']
        ],
        'outcome' => 'The original study reports bounce rate falling from 52% to 34%, repeat visits up 43% and conversion increasing 3×. The source also reports a 15.74% click share from homepage banners. These are source-reported results for the broader work.',
        'metrics' => [['18 pts','Reported bounce-rate reduction'],['43%','Reported repeat-visit increase'],['3×','Reported conversion change']],
        'gallery' => [
            ['url' => 'https://framerusercontent.com/images/ybfdbZl4l5SjYqHFf6y9zHRIL54.png', 'caption' => 'SuperCoin storefront and merchandising experience', 'alt' => 'Flipkart SuperCoin redesigned page'],
            ['url' => 'https://framerusercontent.com/images/QMcOUNMkDRPEP0HsPImMgy7607c.png', 'caption' => 'Coin-based reward cohorts', 'alt' => 'SuperCoin reward variants for different balances'],
            ['url' => 'https://framerusercontent.com/images/VDutDrnbQrnk53Mv14FwxUHrCU.png', 'caption' => 'Combining cash with coins at redemption', 'alt' => 'SuperCoin cash plus coins interface']
        ],
        'lesson' => 'A loyalty system only feels valuable when the available benefits are discoverable and attainable.'
    ],
    'refurbished' => [
        'title' => 'Flipkart Refurbished',
        'eyebrow' => 'Commerce / Trust design',
        'headline' => 'Help shoppers understand exactly what they are buying.',
        'summary' => 'A more transparent purchase journey for professionally refurbished electronics, from the first product impression through checkout.',
        'source' => 'https://www.rishivaths.com/refurbished',
        'challenge' => 'Returns were unusually high. The reference study identifies a 55% post-purchase return rate and describes customers confusing refurbished goods with brand-new electronics discounted heavily.',
        'context' => 'As refurbished shopping moved from 2GUD into the core Flipkart ecosystem, the team needed to communicate product condition inside an established design system.',
        'discovery' => [
            'Fifteen interviews were carried out with customers who had purchased and returned a refurbished item, according to the source.',
            'Many shoppers did not recognize the refurbished label or understand professional inspection, warranty and returns.',
            'The design challenge became one of communicating condition and trust at every important decision point.'
        ],
        'approach' => [
            ['title' => 'Make condition impossible to miss', 'body' => 'Explicit refurbished badges, condition grades and product-title language differentiated restored devices from new products in search and category views.'],
            ['title' => 'Explain before asking users to commit', 'body' => 'The product page introduced condition details, quality-check information, a process explainer and clearer warranty messaging early in the journey.'],
            ['title' => 'Add a thoughtful checkout checkpoint', 'body' => 'A confirmation sheet reminded shoppers they had selected a refurbished product while reinforcing the reasons it could still be a smart purchase.'],
            ['title' => 'Build trust with specifics', 'body' => 'Warranty, replacement terms, quality assessment and pricing comparisons replaced vague reassurance with concrete information.']
        ],
        'outcome' => 'The source reports a three-week A/B test followed by rollout, with the returns metric improving to 32% after five weeks and conversion reported at 2×. The wording in the source also describes this as a 32% reduction, so the exact baseline calculation should be treated cautiously.',
        'metrics' => [['55% → 32%','Reported returns-rate change'],['2×','Reported conversion change'],['15','Interviewees noted in source']],
        'gallery' => [
            ['url' => 'https://framerusercontent.com/images/rTwHkisGHk2OBbRIbDsq31v5Sw.png', 'caption' => 'Refurbished badges in discovery', 'alt' => 'Refurbished phone listing with condition disclosures'],
            ['url' => 'https://framerusercontent.com/images/vEwTwMVRZJKT85XIuj1EJ42y1so.png', 'caption' => 'Product education and condition details', 'alt' => 'Refurbished product-detail education interface'],
            ['url' => 'https://framerusercontent.com/images/FWwi8GBZpNZ6JdEg70ORVbdLEM.png', 'caption' => 'Purchase confirmation and trust cues', 'alt' => 'Refurbished checkout confirmation experience']
        ],
        'lesson' => 'Reducing purchase ambiguity is an experience decision. Clear disclosure protects customer confidence and reduces avoidable returns.'
    ],
    'flipkart-video' => [
        'title' => 'Flipkart Video',
        'eyebrow' => 'Entertainment / Mobile UX',
        'headline' => 'Entertainment designed to live inside a shopping app.',
        'summary' => 'A mobile entertainment destination bringing content browsing, episodic viewing and video playback into the Flipkart ecosystem.',
        'source' => 'https://www.rishivaths.com/flipkartvideo',
        'challenge' => 'The product needed to give people reasons to return to Flipkart beyond transactions, without making entertainment discovery or playback feel like a bolted-on feature.',
        'context' => 'The reference case study describes a new entertainment experience during India’s rapid growth in affordable mobile video consumption.',
        'discovery' => [
            'The concept positioned original and licensed entertainment as a way to deepen engagement with existing customers.',
            'The product needed intuitive discovery for shows, movies, languages and seasons.',
            'Playback features and advertising needed to coexist without overwhelming the viewing experience.'
        ],
        'approach' => [
            ['title' => 'A browsing-first landing experience', 'body' => 'Featured content, autoplay promotion, navigation tabs and language-based collections gave the home screen a clear hierarchy.'],
            ['title' => 'Detail pages built around decisions', 'body' => 'Show posters, season selection, episode lists, favorites and related recommendations made the next action obvious.'],
            ['title' => 'Watch with control', 'body' => 'The player interface supported episode selection plus dedicated audio and subtitle overlays.'],
            ['title' => 'Integrate monetization without losing the story', 'body' => 'Video ad treatments and brand overlays were designed to be noticeable while respecting the content-viewing flow.']
        ],
        'outcome' => 'The reference documents user journeys, UI patterns and stakeholder feedback but does not publish a measurable conversion or retention result for this project. No numerical outcome is claimed here.',
        'metrics' => [['4','Core experience areas'],['Mobile','Primary design surface'],['UX + UI','Interaction and visual patterns']],
        'gallery' => [
            ['url' => 'https://framerusercontent.com/images/lnD0Ky8rxPgeCLBqfcVQtrIUGjA.png', 'caption' => 'Discovery and entertainment homepage', 'alt' => 'Flipkart Video home and content browsing interface'],
            ['url' => 'https://framerusercontent.com/images/LLvZ6zWeE0mNDsb2SdCel2cDA.png', 'caption' => 'Show details, season and episode browsing', 'alt' => 'Flipkart Video details page'],
            ['url' => 'https://framerusercontent.com/images/Hk5hACuwZxtZaTnVIupOG5WVkE.png', 'caption' => 'Video playback and viewer controls', 'alt' => 'Flipkart Video player design']
        ],
        'lesson' => 'Video UX has two distinct jobs: make the next show easy to find, then get out of the way while someone watches.'
    ]
];
