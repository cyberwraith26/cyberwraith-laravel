<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CaseStudySeeder extends Seeder
{
    public function run(): void
    {
        $studies = [

            // ── 1. CyberWraith Platform ───────────────────────────────
            [
                'title'          => 'CyberWraith Platform',
                'client_name'    => 'CyberWraith (Internal)',
                'category'       => 'SaaS Product',
                'emoji'          => '🤖',
                'accent_color'   => '#a855f7',
                'tagline'        => '200+ AI-powered tools for freelancers and agencies — built from scratch in under 6 months.',
                'overview'       => "Freelancers waste hours every week on tasks that don't require human creativity — writing cold emails, formatting proposals, calculating project deposits, building invoices. Existing tools were either too generic, too expensive, or locked behind bloated all-in-one platforms designed for large teams.\n\nCyberWraith was conceived as a focused, dark-UI SaaS built specifically for independent workers and small agencies who need AI horsepower without the enterprise overhead.",
                'challenge'      => "The core challenge was scale and coherence. Building 200+ distinct AI tools — each with its own prompt logic, UI, input schema and output format — without the codebase becoming a maintenance nightmare.\n\nEvery tool needed to feel native to the platform: consistent design language, instant response times, and outputs good enough to use without heavy editing. The AI layer also needed to handle wildly different task types — from technical SEO audits to salary negotiation scripts — without a bloated model-switching architecture.",
                'solution'       => "The platform was built on Laravel 12 with a single slug-based router. Each tool is a lightweight Blade view with a tool-specific prompt injected at request time into the Anthropic Claude Sonnet API. This means adding a new tool requires one Blade file and one config entry — no controller changes, no migrations.\n\nPostgreSQL handles user data, OAuth (Google/GitHub), subscription state and usage tracking. The UI is built entirely in inline styles with JetBrains Mono — zero CSS framework dependencies, which keeps the bundle tiny and the design sharp.\n\nTool categories were organised into 8 verticals: Sales Scripts, Client Intelligence, Freelance Finance, Content Production, Technical SEO, Social Media, Operations and Strategy.",
                'results'        => json_encode([
                    ['metric' => '200+', 'label' => 'AI Tools Shipped'],
                    ['metric' => '6mo',  'label' => 'Build Timeline'],
                    ['metric' => '<1s',  'label' => 'Avg API Response'],
                    ['metric' => '0',    'label' => 'CSS Frameworks Used'],
                ]),
                'tech_stack'     => json_encode(['Laravel 12', 'PHP 8.4', 'PostgreSQL', 'Claude Sonnet API', 'Stripe', 'OAuth2', 'Ubuntu 24.04']),
                'duration_weeks' => 24,
                'created_at'     => now()->subDays(10),
            ],

            // ── 2. Agency Booking Portal ──────────────────────────────
            [
                'title'          => 'Agency Booking Portal',
                'client_name'    => 'Meridian Creative Co.',
                'category'       => 'Client Web App',
                'emoji'          => '🌐',
                'accent_color'   => '#00d4ff',
                'tagline'        => 'Replaced 4 disconnected tools with one custom platform. Admin overhead dropped 60% in 30 days.',
                'overview'       => "Meridian Creative Co. is a 12-person digital marketing agency handling 20–30 active clients at any given time. Their workflow was stitched together across Calendly, Typeform, Google Docs and a shared email inbox — workable when small, a liability at their current size.\n\nLeads were falling through the cracks. Proposals were being sent with wrong pricing. Onboarding a new client took 3 hours of manual work across 4 tools. They needed a single platform built around their actual process.",
                'challenge'      => "The brief was broad: \"make our intake process not a nightmare.\" Translating that into a concrete system required two weeks of process mapping before a single line of code was written.\n\nThe hardest constraint was data portability — the client had 3 years of client history spread across spreadsheets, a CRM trial they'd abandoned, and email threads. All of it needed to live in the new system on day one, or the team wouldn't adopt it.",
                'solution'       => "Built a custom Laravel + Vue.js portal with four core modules: Client Intake (multi-step form with conditional logic), Proposal Builder (template-based with live pricing), Appointment Scheduler (Google Calendar sync via API), and a simple CRM view showing each client's full history in one screen.\n\nData migration was handled with a custom Node.js script that parsed their spreadsheets and populated the database on launch day. Training took under an hour — the UI was designed to be self-explanatory for non-technical agency staff.\n\nThe proposal builder alone saved an estimated 45 minutes per proposal, with the team sending an average of 8 proposals per week.",
                'results'        => json_encode([
                    ['metric' => '60%',  'label' => 'Reduction in Admin Time'],
                    ['metric' => '4→1',  'label' => 'Tools Consolidated'],
                    ['metric' => '45min','label' => 'Saved Per Proposal'],
                    ['metric' => '4.9★', 'label' => 'Client Satisfaction'],
                ]),
                'tech_stack'     => json_encode(['Laravel', 'Vue.js', 'MySQL', 'Google Calendar API', 'AWS S3', 'Forge']),
                'duration_weeks' => 8,
                'created_at'     => now()->subDays(25),
            ],

            // ── 3. E-Commerce Overhaul ────────────────────────────────
            [
                'title'          => 'E-Commerce Overhaul',
                'client_name'    => 'Luma Skin (DTC Brand)',
                'category'       => 'Freelance Case Study',
                'emoji'          => '📈',
                'accent_color'   => '#a855f7',
                'tagline'        => 'Shopify rebuild took conversion rate from 1.2% to 3.8% — a 217% lift — in 90 days post-launch.',
                'overview'       => "Luma Skin is a direct-to-consumer skincare brand doing around \$180K/yr in Shopify revenue. Their store had been built in 2021 by a generalist web designer and hadn't been touched since. Traffic was healthy — paid social was working — but conversion was weak and the mobile experience was broken on anything below 390px wide.\n\nThey approached the project expecting a visual refresh. The audit revealed the problem went much deeper.",
                'challenge'      => "The store had 11 apps installed — 4 of which were unused but still injecting JavaScript. Page load on mobile was 6.8 seconds. The product page had no social proof above the fold. The checkout flow had a mandatory account creation step that was killing 34% of carts at that single point.\n\nThe client's instinct was to change the colour palette. The real fix was technical and structural.",
                'solution'       => "Started with a full CRO audit: heatmaps, session recordings, checkout funnel analysis and a 5-user moderated usability test. Built a prioritised list of 23 changes ranked by effort vs. expected impact.\n\nThe top 5 fixes — guest checkout, above-fold social proof, image compression, removing dead app scripts, and a sticky add-to-cart bar on mobile — were shipped in week one. Conversion moved from 1.2% to 2.1% before the full redesign even launched.\n\nThe new theme was built in Liquid from scratch (not a purchased template), optimised for Core Web Vitals. LCP dropped from 6.8s to 1.4s. The redesigned PDP led with a results-focused headline, UGC photos and a trust block before the fold on all screen sizes.",
                'results'        => json_encode([
                    ['metric' => '3.8%',  'label' => 'Conversion Rate (was 1.2%)'],
                    ['metric' => '+217%', 'label' => 'Conversion Lift'],
                    ['metric' => '1.4s',  'label' => 'Mobile LCP (was 6.8s)'],
                    ['metric' => '+\$94K', 'label' => 'Annualised Revenue Lift'],
                ]),
                'tech_stack'     => json_encode(['Shopify', 'Liquid', 'Google Analytics 4', 'Hotjar', 'PageSpeed Insights', 'Klaviyo']),
                'duration_weeks' => 10,
                'created_at'     => now()->subDays(40),
            ],

            // ── 4. MedSpa Client Portal ───────────────────────────────
            [
                'title'          => 'MedSpa Client Portal',
                'client_name'    => 'Aura Aesthetics Clinic',
                'category'       => 'Client Web App',
                'emoji'          => '🏥',
                'accent_color'   => '#00d4ff',
                'tagline'        => 'Custom intake and aftercare system cut no-shows by 40% and earned a 4.9★ client satisfaction score.',
                'overview'       => "Aura Aesthetics is a boutique medical spa offering injectables, laser treatments and skin consultations. Like most clinics their size, they were running on a generic booking tool that didn't understand their workflow — no pre-treatment intake forms, no consent document collection, no automated aftercare follow-up.\n\nNo-shows were running at 22%, costing an estimated \$3,200/month in lost chair time. Staff were manually sending aftercare PDFs via email after every appointment.",
                'challenge'      => "Healthcare-adjacent applications carry extra data sensitivity requirements. The system needed to handle medical intake data carefully — encrypted at rest, access-logged, and structured so that the clinic could demonstrate responsible handling to their indemnity insurer.\n\nThe second challenge was adoption. The clinic's front desk team had an average age of 47 and low tolerance for complexity. If the new system wasn't immediately intuitive, it would be abandoned within a week.",
                'solution'       => "Built on Laravel with Alpine.js for lightweight interactivity. The client portal has three patient-facing flows: pre-appointment intake (customisable per treatment type), digital consent signing (with timestamp and IP logging), and a post-treatment check-in that triggers automated aftercare messages via Twilio SMS at 24h, 48h and 7 days post-visit.\n\nThe admin panel was designed around the front desk workflow — one screen showing today's appointments, outstanding intake forms and any flagged aftercare responses. No tabs, no menus, no training required.\n\nStripe handles deposits and cancellation fee collection, which directly addressed the no-show problem — patients who have paid a \$50 deposit cancel at a dramatically lower rate.",
                'results'        => json_encode([
                    ['metric' => '40%',   'label' => 'Reduction in No-Shows'],
                    ['metric' => '\$3.2K', 'label' => 'Monthly Revenue Recovered'],
                    ['metric' => '4.9★',  'label' => 'Client Satisfaction Score'],
                    ['metric' => '2hrs',  'label' => 'Weekly Admin Time Saved'],
                ]),
                'tech_stack'     => json_encode(['Laravel', 'Alpine.js', 'Twilio', 'Stripe', 'MySQL', 'Laravel Forge']),
                'duration_weeks' => 7,
                'created_at'     => now()->subDays(55),
            ],

            // ── 5. SaaS Onboarding Redesign ───────────────────────────
            [
                'title'          => 'SaaS Onboarding Redesign',
                'client_name'    => 'Stacklane (B2B SaaS)',
                'category'       => 'Freelance Case Study',
                'emoji'          => '⚡',
                'accent_color'   => '#a855f7',
                'tagline'        => 'Three drop-off points identified and fixed. Activation rate up 34%, 90-day churn down 48%.',
                'overview'       => "Stacklane is a B2B project management tool targeting small dev teams. They had solid top-of-funnel — a steady stream of trial signups from content and Product Hunt — but something was breaking between signup and activation. Their definition of activation was a team creating their first project and inviting at least one other member. Only 18% of trials hit that milestone.\n\nThey brought me in after 6 months of incremental UI tweaks had moved the needle by less than 2%.",
                'challenge'      => "The temptation in onboarding work is to jump straight into redesigning screens. The real problem is usually upstream — the product is making wrong assumptions about what a new user knows or wants to do first.\n\nStacklane's onboarding started with a 9-field registration form including company size, team role and use case. It then dropped users into an empty dashboard with a single \"Create Project\" button and no guidance. Users who didn't create a project within 10 minutes almost never came back.",
                'solution'       => "Started with 3 weeks of research: session recordings of 200 trial sessions, exit surveys, and 6 user interviews with both activated and churned trials. Mapped the full drop-off funnel in Mixpanel — found that 61% of users abandoned during registration, 28% more left the empty dashboard within 90 seconds.\n\nProposed three targeted fixes. First: cut the registration form to email + password only, defer all profiling to post-activation. Second: replace the empty dashboard with a 3-step guided setup that auto-created a sample project with dummy data so users could explore a populated UI. Third: add a contextual tooltip sequence triggered by user behaviour, not a forced product tour.\n\nImplemented in React with feature flags so Stacklane could A/B test each change independently. Full rollout took 5 weeks.",
                'results'        => json_encode([
                    ['metric' => '+34%', 'label' => 'Activation Rate Increase'],
                    ['metric' => '-48%', 'label' => '90-Day Churn Reduction'],
                    ['metric' => '61%',  'label' => 'Drop-off Eliminated at Registration'],
                    ['metric' => '5wks', 'label' => 'Implementation Timeline'],
                ]),
                'tech_stack'     => json_encode(['React', 'Figma', 'Mixpanel', 'Intercom', 'LaunchDarkly', 'Hotjar']),
                'duration_weeks' => 8,
                'created_at'     => now()->subDays(70),
            ],

        ];

        foreach ($studies as $study) {
            DB::table('case_studies')->insert([
                'title'          => $study['title'],
                'slug'           => Str::slug($study['title']),
                'client_name'    => $study['client_name'],
                'category'       => $study['category'],
                'emoji'          => $study['emoji'],
                'accent_color'   => $study['accent_color'],
                'tagline'        => $study['tagline'],
                'overview'       => $study['overview'],
                'challenge'      => $study['challenge'],
                'solution'       => $study['solution'],
                'results'        => $study['results'],
                'tech_stack'     => $study['tech_stack'],
                'duration_weeks' => $study['duration_weeks'],
                'published'      => true,
                'created_at'     => $study['created_at'],
                'updated_at'     => $study['created_at'],
            ]);
        }

        $this->command->info('✓ 5 case studies seeded.');
    }
}
