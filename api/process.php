<?php
// ================================================================
// HARBOUR TECH — PHP Array, String & Regex Operations
// Experiment: Sorting, Searching, Merging, Regex, String Ops
// This file contains the logic separated from index.html
// ================================================================

// ---- 1. SERVICES DATA — PHP Array (for sorting with usort) ----
$services = [
    [
        'num' => '01', 
        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="3" rx="2"></rect><line x1="8" x2="16" y1="21" y2="21"></line><line x1="12" x2="12" y1="17" y2="21"></line></svg>', 
        'title' => 'Web &amp; App Development', 
        'desc' => 'Responsive, scalable applications built with modern frameworks. From MVPs to enterprise platforms.', 
        'tags' => ['React', 'Node.js', 'TypeScript']
    ],
    [
        'num' => '02', 
        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.5 19a3.5 3.5 0 0 0 0-7c-.3 0-.6 0-.9.1a5 5 0 0 0-9.8 1.4c0 .5.1 1 .2 1.5a3.5 3.5 0 0 0 0 7z"></path></svg>', 
        'title' => 'Cloud Infrastructure', 
        'desc' => 'Design, migrate, and manage cloud environments on AWS, Azure, and GCP with zero-downtime deployments.', 
        'tags' => ['AWS', 'Docker', 'Kubernetes']
    ],
    [
        'num' => '03', 
        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8V4H8"></path><rect width="16" height="12" x="4" y="8" rx="2"></rect><path d="M2 14h2"></path><path d="M20 14h2"></path><path d="M15 13v2"></path><path d="M9 13v2"></path></svg>', 
        'title' => 'AI &amp; Analytics', 
        'desc' => 'Machine learning models and data pipelines that turn raw data into actionable business intelligence.', 
        'tags' => ['Python', 'TensorFlow', 'Power BI']
    ],
    [
        'num' => '04', 
        'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>', 
        'title' => 'Cybersecurity', 
        'desc' => 'Penetration testing, vulnerability assessments, and compliance audits to protect what matters most.', 
        'tags' => ['ISO 27001', 'Pen Testing', 'VAPT']
    ],
];

// ---- TESTIMONIALS DATA ----
$reviews = [
    [
        'name' => 'Ravi Mehta',
        'role' => 'CEO, ShopNova India',
        'text' => 'Harbour Tech transformed our legacy e-commerce platform into a lightning-fast React app in just 8 weeks. Revenue increased 34% in the first month post-launch. Absolutely exceptional team.',
        'avatar' => 'R',
        'color' => 'indigo',
        'grad' => 'linear-gradient(135deg,#6366f1,#06b6d4)'
    ],
    [
        'name' => 'Priya Sharma',
        'role' => 'CTO, FinBridge Solutions',
        'text' => 'Their cloud migration project saved us ₹18L/year in infrastructure costs. Zero downtime during the entire migration. Harbour Tech delivered what others said was impossible.',
        'avatar' => 'P',
        'color' => 'emerald',
        'grad' => 'linear-gradient(135deg,#10b981,#059669)'
    ],
    [
        'name' => 'Arjun Kapoor',
        'role' => 'Operations Head, LogiTrack',
        'text' => 'The AI analytics dashboard they built gives us insights we never had before. Our operations team now catches anomalies 72 hours earlier. Game-changer for our logistics.',
        'avatar' => 'A',
        'color' => 'amber',
        'grad' => 'linear-gradient(135deg,#f59e0b,#ef4444)'
    ],
    [
        'name' => 'Sneha Iyer',
        'role' => 'Founder, HealthFirst App',
        'text' => 'We hired 3 agencies before Harbour Tech. None delivered. These guys not only shipped on time but came in 12% under budget. Communication was top-notch throughout.',
        'avatar' => 'S',
        'color' => 'violet',
        'grad' => 'linear-gradient(135deg,#8b5cf6,#6366f1)'
    ],
    [
        'name' => 'Karthik Nair',
        'role' => 'CISO, DataVault Corp',
        'text' => 'From penetration testing to ISO compliance — Harbour Tech handled everything. Our enterprise clients now have zero security objections during procurement.',
        'avatar' => 'K',
        'color' => 'cyan',
        'grad' => 'linear-gradient(135deg,#06b6d4,#0891b2)'
    ],
    [
        'name' => 'Meera Reddy',
        'role' => 'Product Lead, FitFlow Global',
        'text' => 'The React Native app they built for us has a 4.9 rating on the App Store. The performance is native-like and our user engagement has doubled since the migration.',
        'avatar' => 'M',
        'color' => 'rose',
        'grad' => 'linear-gradient(135deg,#ec4899,#f43f5e)'
    ]
];

// PHP sort() / usort() — sort services by title
$sort_order = isset($_GET['sort_services']) ? $_GET['sort_services'] : 'default';
$sort_label = 'Default Order';
if ($sort_order === 'asc') {
    usort($services, function($a, $b) { return strcmp($a['title'], $b['title']); });
    $sort_label = 'A → Z';
} elseif ($sort_order === 'desc') {
    usort($services, function($a, $b) { return strcmp($b['title'], $a['title']); });
    $sort_label = 'Z → A';
}

// ---- 2. PRICING DATA — PHP array_merge() ----
$base_features = ['Responsive design', 'SEO optimization', 'Performance audit'];

$starter_specific = ['Up to 5 pages / screens', '2 weeks delivery', '1 revision round'];
$growth_specific  = ['Full-stack application', 'Cloud deployment (AWS/GCP)', 'API integration', 'Analytics dashboard', '3 revision rounds', '30-day support'];
$enterprise_specific = ['Dedicated team', 'Custom architecture', 'AI/ML integration', '24/7 priority support', 'SLA guarantee', 'Security audit included'];

// array_merge() — combine base features with tier-specific features
$starter_all    = array_merge($base_features, $starter_specific);
$growth_all     = array_merge($base_features, $growth_specific);
$enterprise_all = array_merge($base_features, $enterprise_specific);

$pricing_plans = [
    ['tier' => 'Starter',    'desc' => 'Perfect for MVPs and small-scale projects',       'amount' => '<span class="currency">₹</span>49,999<span class="period">/project</span>',  'features' => $starter_all,    'btn_class' => 'btn-pricing btn-pricing-outline',  'btn_action' => "initiatePayment('Starter', 49999)",   'featured' => false],
    ['tier' => 'Growth',     'desc' => 'For businesses ready to scale and grow',           'amount' => '<span class="currency">₹</span>1,49,999<span class="period">/project</span>', 'features' => $growth_all,     'btn_class' => 'btn-pricing btn-pricing-primary',  'btn_action' => "initiatePayment('Growth', 149999)",   'featured' => true],
    ['tier' => 'Enterprise', 'desc' => 'Tailored solutions for large organizations',       'amount' => 'Custom',                                                                      'features' => $enterprise_all, 'btn_class' => 'btn-pricing btn-pricing-outline',  'btn_action' => "document.getElementById('contact').scrollIntoView({behavior:'smooth'})", 'featured' => false],
];

// PHP in_array() / searching — search for a feature across all plans
$search_feature = isset($_GET['search_feature']) ? trim($_GET['search_feature']) : '';
$search_results = [];
if (!empty($search_feature)) {
    foreach ($pricing_plans as $plan) {
        foreach ($plan['features'] as $f) {
            if (stripos($f, $search_feature) !== false) {
                $search_results[$plan['tier']][] = $f;
            }
        }
    }
}

// ---- 3. CONTACT — String manipulation + Regex validation ----
$contact_processed = false;
$formatted_name = '';
$email_domain = '';
$phone_status = '';
$email_status = '';
$post_name = '';
$post_email = '';
$post_phone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_php'])) {
    $contact_processed = true;
    $post_name  = $_POST['user_name']  ?? '';
    $post_email = $_POST['user_email'] ?? '';
    $post_phone = $_POST['user_phone'] ?? '';

    // String: ucwords() + strtolower() + trim() — format full name
    $formatted_name = ucwords(strtolower(trim($post_name)));

    // String: explode() — extract domain from email
    if (!empty($post_email) && strpos($post_email, '@') !== false) {
        $parts = explode('@', $post_email);
        $email_domain = $parts[1];
    }

    // Regex: preg_match() — validate Indian phone number
    $clean_phone = preg_replace('/[\s\-\+]/', '', $post_phone);
    if (preg_match('/^(91)?[6-9][0-9]{9}$/', $clean_phone)) {
        $phone_status = 'valid';
    } else {
        $phone_status = 'invalid';
    }

    // Regex: preg_match() — validate email format
    if (preg_match('/^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/', $post_email)) {
        $email_status = 'valid';
    } else {
        $email_status = 'invalid';
    }
}
