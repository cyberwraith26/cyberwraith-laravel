<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title'     => 'How to Price Your Freelance Services in 2026 (Without Underselling Yourself)',
                'category'  => 'Freelancing',
                'emoji'     => '💰',
                'read_time' => 8,
                'excerpt'   => 'Most freelancers price based on fear, not value. Here\'s a data-driven framework to set rates that win clients and pay you what you\'re actually worth.',
                'content'   => 'Pricing is the single most impactful lever in your freelance business...',
                'created_at' => now()->subDays(2),
            ],
            [
                'title'     => 'The Cold Email Playbook That Books 3–5 Discovery Calls Per Week',
                'category'  => 'Freelancing',
                'emoji'     => '📧',
                'read_time' => 10,
                'excerpt'   => 'Cold email still works — but only when you stop writing generic pitches. This is the exact system top freelancers use to fill their pipeline consistently.',
                'content'   => 'Cold email gets a bad reputation because most people do it wrong...',
                'created_at' => now()->subDays(5),
            ],
            [
                'title'     => 'Building a SaaS on a Freelance Budget: From $0 to First Paying Customer',
                'category'  => 'SaaS',
                'emoji'     => '🚀',
                'read_time' => 12,
                'excerpt'   => 'You don\'t need VC funding to launch a SaaS. Here\'s the lean playbook for freelancers who want to build a product without quitting their client work.',
                'content'   => 'The idea of building a SaaS while freelancing sounds impossible...',
                'created_at' => now()->subDays(8),
            ],
            [
                'title'     => 'Linux Server Security: The Essential Checklist Every Developer Needs',
                'category'  => 'Security',
                'emoji'     => '🔐',
                'read_time' => 9,
                'excerpt'   => 'A misconfigured Linux server is an open door for attackers. Run through this checklist on every new VPS you spin up to lock down the basics in under 30 minutes.',
                'content'   => 'Whether you\'re deploying a Laravel app, a Node API, or a blockchain node...',
                'created_at' => now()->subDays(11),
            ],
            [
                'title'     => 'How to Write Proposals That Win 60%+ of the Time',
                'category'  => 'Freelancing',
                'emoji'     => '📋',
                'read_time' => 7,
                'excerpt'   => 'The average freelance proposal win rate is under 20%. Here\'s the structure, psychology and formatting that flips those odds dramatically in your favour.',
                'content'   => 'Most proposals fail before the client reads past the first paragraph...',
                'created_at' => now()->subDays(14),
            ],
            [
                'title'     => 'The Freelancer\'s Complete Guide to Productized Services',
                'category'  => 'Business',
                'emoji'     => '📦',
                'read_time' => 11,
                'excerpt'   => 'Productizing your service means escaping the hourly trap, predicting your income, and scaling without burning out. Here\'s how to do it step by step.',
                'content'   => 'When you sell custom services, every project is a new negotiation...',
                'created_at' => now()->subDays(17),
            ],
            [
                'title'     => 'AI Tools That Actually Save Freelancers Time in 2026',
                'category'  => 'Productivity',
                'emoji'     => '🤖',
                'read_time' => 6,
                'excerpt'   => 'There are hundreds of AI tools claiming to 10x your productivity. These are the ones that actually deliver — tested and vetted by working freelancers.',
                'content'   => 'The AI tool landscape is overwhelming. New products launch daily...',
                'created_at' => now()->subDays(20),
            ],
            [
                'title'     => 'How to Handle Scope Creep Before It Destroys Your Project',
                'category'  => 'Business',
                'emoji'     => '🛡️',
                'read_time' => 8,
                'excerpt'   => 'Scope creep is the silent killer of freelance profitability. Learn the early warning signs, the contract clauses that protect you, and scripts for the awkward conversation.',
                'content'   => 'It starts innocently: "Can we just add one small thing?"...',
                'created_at' => now()->subDays(23),
            ],
            [
                'title'     => 'Growing Your Agency from Solo to 5-Person Team: What Nobody Tells You',
                'category'  => 'Business',
                'emoji'     => '📈',
                'read_time' => 13,
                'excerpt'   => 'Scaling from solo freelancer to agency is one of the hardest transitions in the business. Here\'s what to expect, what to delegate first, and how to avoid the common traps.',
                'content'   => 'The decision to hire your first subcontractor feels massive...',
                'created_at' => now()->subDays(26),
            ],
            [
                'title'     => 'Time Blocking for Freelancers: The System That Reclaims Your Week',
                'category'  => 'Productivity',
                'emoji'     => '⏱️',
                'read_time' => 7,
                'excerpt'   => 'Without structure, freelancing becomes reactive chaos. Time blocking is the single productivity technique with the highest ROI for independent workers.',
                'content'   => 'Most freelancers run their day by checking email first...',
                'created_at' => now()->subDays(29),
            ],
            [
                'title'     => 'Laravel vs Node.js for Your Next SaaS: A Practical Breakdown',
                'category'  => 'SaaS',
                'emoji'     => '⚡',
                'read_time' => 9,
                'excerpt'   => 'Choosing a backend stack for a SaaS can feel paralyzing. We break down both frameworks honestly across developer experience, performance, ecosystem and hiring.',
                'content'   => 'When starting a SaaS in 2026, the backend stack debate is real...',
                'created_at' => now()->subDays(32),
            ],
            [
                'title'     => 'How to Find High-Paying Clients on LinkedIn (Without Being Spammy)',
                'category'  => 'Freelancing',
                'emoji'     => '🎯',
                'read_time' => 8,
                'excerpt'   => 'LinkedIn is the highest-ROI platform for B2B freelancers — if you use it right. This guide shows you the profile setup, outreach cadence and content strategy that attracts inbound leads.',
                'content'   => 'LinkedIn has over 900 million professionals and most freelancers barely scratch the surface...',
                'created_at' => now()->subDays(35),
            ],
            [
                'title'     => 'The GDPR Compliance Checklist for Freelancers and Small Agencies',
                'category'  => 'Security',
                'emoji'     => '🔒',
                'read_time' => 10,
                'excerpt'   => 'GDPR isn\'t just for big companies. If you handle client data in the EU — or work with EU-based clients — you need to be compliant. Here\'s the practical checklist.',
                'content'   => 'The fines for GDPR violations can reach €20 million or 4% of global turnover...',
                'created_at' => now()->subDays(38),
            ],
            [
                'title'     => 'Retainer Clients: How to Convert One-Off Projects into Monthly Income',
                'category'  => 'Freelancing',
                'emoji'     => '🔄',
                'read_time' => 9,
                'excerpt'   => 'Retainers are the closest thing freelancing has to a salary. Here\'s the exact pitch, the pricing structure and the service packaging that makes clients say yes.',
                'content'   => 'Every freelancer dreams of predictable monthly income...',
                'created_at' => now()->subDays(41),
            ],
            [
                'title'     => 'SaaS Pricing Psychology: Why Most Pricing Pages Are Leaving Money on the Table',
                'category'  => 'SaaS',
                'emoji'     => '💡',
                'read_time' => 11,
                'excerpt'   => 'The way you present your pricing affects conversions more than the actual price. We break down anchoring, decoy pricing, and the 3-tier structure that maximises revenue.',
                'content'   => 'Pricing psychology is the most underutilised growth lever in SaaS...',
                'created_at' => now()->subDays(44),
            ],
            [
                'title'     => 'Building in Public: The Honest Case For and Against It',
                'category'  => 'Business',
                'emoji'     => '🌐',
                'read_time' => 7,
                'excerpt'   => 'Building in public has launched careers and products — but it\'s not for everyone. Here\'s an honest breakdown of when it works, when it backfires, and how to do it right.',
                'content'   => '#BuildingInPublic is everywhere on X. Success stories, revenue milestones, follower growth...',
                'created_at' => now()->subDays(47),
            ],
            [
                'title'     => 'The Freelancer\'s Guide to Paying Less Tax (Legally)',
                'category'  => 'Freelancing',
                'emoji'     => '🧾',
                'read_time' => 10,
                'excerpt'   => 'Most freelancers overpay tax because they don\'t know the deductions available to them. This guide covers the most commonly missed write-offs for self-employed workers.',
                'content'   => 'Tax is one of the biggest expenses in a freelance business...',
                'created_at' => now()->subDays(50),
            ],
            [
                'title'     => 'Deep Work for Developers: How to Get 6 Hours of Focused Output Per Day',
                'category'  => 'Productivity',
                'emoji'     => '🧠',
                'read_time' => 8,
                'excerpt'   => 'The average knowledge worker gets under 3 hours of deep focus per day. For developers and designers, that gap costs serious money. Here\'s how to fix it.',
                'content'   => 'Cal Newport\'s Deep Work concept isn\'t just a book summary to save for later...',
                'created_at' => now()->subDays(53),
            ],
            [
                'title'     => 'What I Learned from 50 Failed Freelance Proposals',
                'category'  => 'Freelancing',
                'emoji'     => '💪',
                'read_time' => 6,
                'excerpt'   => 'After analysing 50 losing proposals, the patterns are clear. Here are the most common mistakes that kill deals — and the simple fixes that change everything.',
                'content'   => 'I\'ve sent hundreds of proposals over 7 years of freelancing...',
                'created_at' => now()->subDays(56),
            ],
            [
                'title'     => 'API Security Best Practices Every Developer Should Know in 2026',
                'category'  => 'Security',
                'emoji'     => '🛡️',
                'read_time' => 12,
                'excerpt'   => 'APIs are the attack surface of modern applications. From authentication to rate limiting to input validation, here\'s the complete security checklist for APIs in production.',
                'content'   => 'In 2026, API attacks account for a growing share of all security incidents...',
                'created_at' => now()->subDays(59),
            ],
        ];

        foreach ($posts as $post) {
            DB::table('blog_posts')->insert([
                'title'      => $post['title'],
                'slug'       => Str::slug($post['title']),
                'excerpt'    => $post['excerpt'],
                'content'    => $post['content'],
                'category'   => $post['category'],
                'emoji'      => $post['emoji'],
                'read_time'  => $post['read_time'],
                'published'  => true,
                'created_at' => $post['created_at'],
                'updated_at' => $post['created_at'],
            ]);
        }

        $this->command->info('✓ 20 blog posts seeded.');
    }
}
