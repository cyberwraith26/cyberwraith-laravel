<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    private function services(): array
    {
        return [
            'web-development' => [
                'icon'        => '🌐',
                'color'       => '#00d4ff',
                'tag'         => 'Development',
                'name'        => 'Web Development',
                'slug'        => 'web-development',
                'tagline'     => 'Full-stack applications built to last.',
                'description' => 'Full-stack web applications, SaaS platforms and APIs built with modern technologies and best practices. From MVP to enterprise-scale.',
                'starting'    => '$1,500',
                'delivery'    => '2–12 weeks',
                'features'    => [
                    'Full-stack Laravel / Next.js development',
                    'SaaS platform architecture & build',
                    'REST API design and development',
                    'PostgreSQL / MySQL database design',
                    'AWS / Railway / Vercel deployment',
                    'Performance optimization & scaling',
                ],
                'overview'    => 'We build full-stack web applications that are fast, maintainable and built to scale. Whether you need an MVP launched in two weeks or an enterprise platform architected from the ground up, we bring the technical depth to get it right the first time.',
                'problem'     => 'Most development projects fail not because of bad code, but because of bad architecture decisions made early. Poor database design, monolithic structures that resist scaling, and lack of documentation leave teams with applications that are expensive to maintain and impossible to hand off.',
                'approach'    => 'We start every project with an architecture review — understanding your data model, traffic expectations and integration requirements before writing a single line of code. We favour Laravel for backend APIs and SaaS platforms, Next.js for frontend-heavy products, and PostgreSQL for all relational data. Every project ships with documentation, clean Git history and a handoff call.',
                'deliverables'=> ['Full source code with clean Git history', 'Technical documentation & README', 'Deployment pipeline (CI/CD)', 'Database schema documentation', 'Handoff call & 30-day support window'],
                'process'     => [
                    ['Discovery call', 'We map your requirements, timeline and budget in a 60-minute call.'],
                    ['Architecture proposal', 'You receive a written tech spec with stack decisions and rationale.'],
                    ['Iterative build', 'We ship in sprints with weekly demos so you stay in the loop.'],
                    ['QA & deployment', 'Full testing, deployment and documentation before handoff.'],
                ],
                'faqs'        => [
                    ['Do you work with existing codebases?', 'Yes. We regularly audit and extend existing Laravel and Next.js applications. We will always give you an honest assessment before committing to a timeline.'],
                    ['Can you handle the design too?', 'We can produce functional UI from wireframes or a design system. For brand-level design work we collaborate with trusted design partners.'],
                    ['Do you offer ongoing maintenance?', 'Yes — monthly retainers are available after project delivery for bug fixes, feature additions and security updates.'],
                ],
                'testimonial' => ['The architecture review alone saved us months of rework. They spotted a database design issue that would have cost us everything at scale.', 'James O., SaaS Founder'],
            ],

            'security-audits' => [
                'icon'        => '🔒',
                'color'       => '#ef4444',
                'tag'         => 'Security',
                'name'        => 'Security Audits',
                'slug'        => 'security-audits',
                'tagline'     => 'Find the vulnerabilities before attackers do.',
                'description' => 'Comprehensive penetration testing and vulnerability assessments to identify and remediate security risks before they become incidents.',
                'starting'    => '$800',
                'delivery'    => '3–10 business days',
                'features'    => [
                    'Web application penetration testing',
                    'API security assessment',
                    'OWASP Top 10 vulnerability scan',
                    'Authentication & session security review',
                    'Detailed report with remediation steps',
                    'Follow-up verification testing',
                ],
                'overview'    => 'A security breach is not a matter of if — it is a matter of when, and how prepared you are. Our security audit service gives you a clear, prioritised picture of your application\'s vulnerabilities and exactly what to do about each one.',
                'problem'     => 'Most web applications are deployed with critical security vulnerabilities that developers simply did not know to look for. SQL injection, broken authentication, insecure direct object references and misconfigured CORS headers are found in the majority of applications we audit — including those built by experienced teams.',
                'approach'    => 'We conduct manual and automated testing against the OWASP Top 10 and beyond. Every finding is documented with a severity rating (Critical / High / Medium / Low), a clear explanation of the risk, proof-of-concept reproduction steps and concrete remediation guidance. We do not just hand you a scanner report — we tell you what it means and what to fix first.',
                'deliverables'=> ['Executive summary (non-technical)', 'Full technical vulnerability report', 'Severity-rated finding list', 'Remediation guidance per finding', 'Follow-up re-test after fixes applied'],
                'process'     => [
                    ['Scoping call', 'We define the target scope, test environment and rules of engagement.'],
                    ['Reconnaissance', 'Passive and active information gathering on the target surface.'],
                    ['Testing', 'Manual and tool-assisted testing against all agreed surfaces.'],
                    ['Report & re-test', 'Detailed findings delivered, then re-tested after your team remediates.'],
                ],
                'faqs'        => [
                    ['Will testing affect my production environment?', 'We always prefer a staging environment. If production testing is required, we agree on a low-traffic window and use non-destructive techniques only.'],
                    ['What standards do you test against?', 'Primarily OWASP Top 10 and OWASP API Security Top 10, supplemented by CWE/SANS Top 25 for logic and implementation flaws.'],
                    ['Do you provide a compliance-ready report?', 'Our reports are structured to support SOC 2, ISO 27001 and GDPR audit requirements. Let us know your compliance context at scoping.'],
                ],
                'testimonial' => ['They found three critical vulnerabilities in our payment flow that our own team had missed entirely. The report was clear enough that our developers fixed everything within a day.', 'Afia M., SaaS Founder'],
            ],

            'linux-administration' => [
                'icon'        => '🐧',
                'color'       => '#a855f7',
                'tag'         => 'Infrastructure',
                'name'        => 'Linux Administration',
                'slug'        => 'linux-administration',
                'tagline'     => 'Reliable, hardened infrastructure without the full-time hire.',
                'description' => 'Server setup, hardening, monitoring and ongoing administration for teams that need reliable, secure infrastructure without hiring a full-time sysadmin.',
                'starting'    => '$350',
                'delivery'    => '1–5 business days',
                'features'    => [
                    'VPS / dedicated server setup',
                    'Security hardening & firewall config',
                    'Nginx / Apache / Caddy configuration',
                    'SSL certificates & auto-renewal',
                    'Automated backups & monitoring',
                    'Ongoing monthly retainer available',
                ],
                'overview'    => 'Your application is only as reliable as the infrastructure it runs on. We set up, harden and maintain Linux servers so your team can focus on building the product instead of fighting with sysadmin tasks.',
                'problem'     => 'Most small teams deploy to a VPS with a basic setup and never revisit it. Default configurations leave SSH open to brute force, no automated backups running, no monitoring, and outdated packages with known CVEs. It takes one incident to realise how expensive that is.',
                'approach'    => 'We work on Ubuntu 24.04 LTS and Debian as primary distributions. Every server we touch gets: SSH hardened (key-only auth, non-standard port, fail2ban), UFW firewall configured, automatic security updates enabled, Nginx or Caddy set up with proper SSL via Let\'s Encrypt, and a monitoring stack with uptime and disk alerting. We document everything we do so you are never dependent on us.',
                'deliverables'=> ['Fully configured & hardened server', 'Server setup documentation', 'Monitoring & alerting configured', 'Backup strategy implemented', 'SSH access handoff to your team'],
                'process'     => [
                    ['Requirements call', 'We learn your stack, traffic expectations and compliance requirements.'],
                    ['Server provisioning', 'OS install, initial hardening and base configuration.'],
                    ['Application setup', 'Web server, database, SSL, deployment pipeline.'],
                    ['Handoff & documentation', 'Full written runbook and access transfer to your team.'],
                ],
                'faqs'        => [
                    ['Which hosting providers do you work with?', 'DigitalOcean, Hetzner, Linode, Vultr, AWS EC2 and OVH. We can work with any provider that gives root SSH access.'],
                    ['Can you migrate our existing server?', 'Yes. We handle zero-downtime migrations including DNS cutover, data migration and post-migration verification.'],
                    ['Do you offer ongoing management?', 'Yes — monthly retainers cover security patching, monitoring response, backup verification and up to 4 hours of admin tasks per month.'],
                ],
                'testimonial' => ['Our server was a ticking time bomb. They hardened it, set up proper backups and monitoring, and documented everything. Now I actually sleep at night.', 'Marcus T., Digital Marketing Consultant'],
            ],

            'saas-consulting' => [
                'icon'        => '🚀',
                'color'       => '#f59e0b',
                'tag'         => 'Strategy',
                'name'        => 'SaaS Consulting',
                'slug'        => 'saas-consulting',
                'tagline'     => 'Build the right thing, the right way, from day one.',
                'description' => 'Architecture guidance, tech stack decisions and go-to-market strategy for SaaS founders who want to build right the first time.',
                'starting'    => '$500',
                'delivery'    => 'Ongoing / project-based',
                'features'    => [
                    'Tech stack selection & architecture',
                    'SaaS pricing model strategy',
                    'Onboarding flow design',
                    'Churn analysis & retention strategy',
                    'Investor-ready technical documentation',
                    'Fractional CTO engagement available',
                ],
                'overview'    => 'Building a SaaS is one of the hardest things a founder can do. The decisions you make in the first three months — stack, architecture, pricing, onboarding — determine whether you are fighting fires at 1,000 users or scaling cleanly to 100,000. We help you make those decisions with confidence.',
                'problem'     => 'Most SaaS founders are either technical and lack go-to-market experience, or commercial and deferring all technical decisions to a contractor who may not have product context. The result is products that work but do not grow, or products that grow but break. The gap between "it works" and "it scales" is where most early-stage SaaS products stall.',
                'approach'    => 'We engage as a fractional CTO or strategic advisor — depending on what the business needs. We run a structured discovery to understand your market, technical constraints and growth targets, then produce a written strategy covering: tech stack recommendation with rationale, architecture for your first 10K users, pricing model analysis, onboarding flow design and a 90-day technical roadmap. We stay engaged to review decisions as they are made.',
                'deliverables'=> ['Written technical strategy document', '90-day technical roadmap', 'Stack recommendation with rationale', 'Onboarding flow wireframes & logic', 'Pricing model analysis & recommendation'],
                'process'     => [
                    ['Founder deep-dive', 'A 90-minute call to understand the product, market and team.'],
                    ['Research & analysis', 'We review your existing code, metrics and competitive landscape.'],
                    ['Strategy delivery', 'Written strategy document with full rationale delivered within 5 days.'],
                    ['Ongoing advisory', 'Weekly or bi-weekly check-ins to review decisions as they arise.'],
                ],
                'faqs'        => [
                    ['We already have a technical co-founder — can you still help?', 'Absolutely. Many of our engagements are with technical co-founders who want an experienced outside perspective on architecture and go-to-market decisions.'],
                    ['Can you help us prepare for a technical due diligence?', 'Yes. We produce investor-ready technical documentation and can join DD calls to answer questions about architecture, security posture and scalability.'],
                    ['What does a fractional CTO engagement look like?', 'Typically 4–8 hours per week of availability covering async reviews, weekly calls and on-demand input on architectural decisions. Priced on a monthly retainer.'],
                ],
                'testimonial' => ['The strategy session paid for itself before we wrote a single line of code. We avoided a tech stack mistake that would have cost us 3 months of rework.', 'David C., SaaS Founder'],
            ],
        ];
    }

    public function index()
    {
        return view('landing.services.index');
    }

    public function show(string $slug)
    {
        $services = $this->services();

        if (!array_key_exists($slug, $services)) {
            abort(404);
        }

        $service = $services[$slug];

        // Other services for "More Services" section
        $others = collect($services)->filter(fn($s) => $s['slug'] !== $slug)->values()->take(3)->toArray();

        return view('landing.services.show', compact('service', 'others'));
    }
}
