<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Global Logistics SaaS',
            'description' => 'Client: BlueDart Enterprise - A comprehensive logistics and supply chain management platform with real-time tracking.',
            'tech_stack' => 'React, Node.js, PostgreSQL',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 150
        ]);

        Project::create([
            'title' => 'FinTech Wallet App',
            'description' => 'Client: Zenith Bank - Secure mobile wallet application featuring instant peer-to-peer transfers and biometric authentication.',
            'tech_stack' => 'React Native, Node.js, MongoDB',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 210
        ]);

        Project::create([
            'title' => 'E-commerce Platform',
            'description' => 'Client: LuxStore India - Scalable e-commerce solution with advanced search, personalized recommendations, and seamless checkout.',
            'tech_stack' => 'Next.js, TailwindCSS, Stripe',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 185
        ]);

        Project::create([
            'title' => 'Smart City Analytics',
            'description' => 'Client: Metropolis Corp - Data visualization dashboard aggregating real-time IoT sensor data for urban planning.',
            'tech_stack' => 'Vue.js, Python, Django',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 130
        ]);
    }
}
