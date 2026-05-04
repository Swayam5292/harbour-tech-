<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Nexus Cloud Infrastructure',
            'description' => 'A high-availability cloud migration for a global fintech client, reducing latency by 45% using AWS Lambda and Terraform.',
            'tech_stack' => 'AWS, Terraform, Go, Docker',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 124
        ]);

        Project::create([
            'title' => 'Sentient AI Dashboard',
            'description' => 'Real-time predictive analytics platform that identifies market anomalies using LSTM neural networks and Python.',
            'tech_stack' => 'Python, TensorFlow, React, FastAPI',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 89
        ]);

        Project::create([
            'title' => 'ShieldVault Cybersecurity',
            'description' => 'Enterprise-grade zero-trust security framework implementation with automated penetration testing pipelines.',
            'tech_stack' => 'Python, Bash, Kubernetes, Azure',
            'github_url' => 'https://github.com',
            'live_url' => 'https://example.com',
            'status' => 'active',
            'likes' => 256
        ]);
    }
}
