<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $reviews = [
            [
                'name' => 'Krrish Parrot',
                'role' => 'CEO, ShopNova India',
                'avatar' => 'R',
                'color' => 'indigo',
                'text' => 'Harbour Tech transformed our legacy e-commerce platform into a lightning-fast React app in just 8 weeks. Revenue increased <strong>34%</strong> in the first month post-launch. Absolutely exceptional team — best tech partner we\'ve ever worked with.',
                'impact' => '📈 +34% Revenue in Month 1',
                'featured' => true
            ],
            [
                'name' => 'Akshay Parab',
                'role' => 'CTO, FinBridge Solutions',
                'avatar' => 'P',
                'color' => 'emerald',
                'text' => 'Their cloud migration project saved us <strong>₹18L/year</strong> in infrastructure costs. Zero downtime during the entire migration. Harbour Tech delivered what others said was impossible.',
                'impact' => '☁️ ₹18L/year Saved',
                'featured' => false
            ],
            [
                'name' => 'Arjun Kapoor',
                'role' => 'Operations Head, LogiTrack',
                'avatar' => 'A',
                'color' => 'amber',
                'text' => 'The AI analytics dashboard gives us insights we never had before. Our ops team catches anomalies <strong>72 hours earlier</strong>. Game-changer for our logistics chain.',
                'impact' => '🤖 72hr Earlier Anomaly Detection',
                'featured' => false
            ],
            [
                'name' => 'Jainam Solanki',
                'role' => 'Founder, HealthFirst App',
                'avatar' => 'S',
                'color' => 'violet',
                'text' => 'We hired 3 agencies before Harbour Tech. None delivered. These guys not only shipped on time but came in <strong>12% under budget</strong>. Communication was top-notch throughout.',
                'impact' => '✅ On time, 12% under budget',
                'featured' => false
            ],
            [
                'name' => 'Rang Patel',
                'role' => 'CISO, DataVault Corp',
                'avatar' => 'K',
                'color' => 'cyan',
                'text' => 'From penetration testing to ISO compliance — Harbour Tech handled everything. Our enterprise clients now have <strong>zero security objections</strong> during procurement.',
                'impact' => '🔒 Zero Security Objections',
                'featured' => false
            ],
            [
                'name' => 'Meera Reddy',
                'role' => 'Product Lead, FitFlow Global',
                'avatar' => 'M',
                'color' => 'rose',
                'text' => 'The React Native app they built has a <strong>4.9 rating</strong> on the App Store. Performance is native-like and user engagement has doubled since the migration.',
                'impact' => '📱 4.9★ App Store Rating',
                'featured' => false
            ]
        ];

        return view('welcome', compact('reviews'));
    }
}
