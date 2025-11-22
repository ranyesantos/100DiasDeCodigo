<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Spatie\Tags\Tag;

return new class extends Migration
{
    public function up(): void
    {
        $fieldTypes = [
            'Back-end Development',
            'Front-end Development',
            'Full-stack Development',
            'DevOps Engineering',
            'Mobile Development',
            'Data Science',
            'Data Engineering',
            'Machine Learning',
            'Artificial Intelligence',
            'Quality Assurance (QA)',
            'UI/UX Design',
            'Cybersecurity',
            'Product Management',
            'Cloud Architecture',
            'Database Administration',
            'Network Engineering',
            'System Administration',
            'Game Development',
            'Embedded Systems',
            'Blockchain Development',
            'Site Reliability Engineering (SRE)',
            'Technical Writing',
            'Developer Relations',
            'Engineering Management',
            'Scrum Master',
        ];

        foreach ($fieldTypes as $type) {
            Tag::findOrCreate($type, 'field_type');
        }

        $technologies = [
            'PHP', 'Laravel', 'JavaScript', 'TypeScript', 'React', 'Vue.js', 'Angular', 'Node.js',
            'Python', 'Django', 'Flask', 'FastAPI', 'Java', 'Spring Boot', 'C#', '.NET', 'ASP.NET Core',
            'Go', 'Rust', 'Ruby', 'Ruby on Rails', 'Swift', 'Kotlin', 'Dart', 'Flutter',
            'Docker', 'Kubernetes', 'AWS', 'Azure', 'Google Cloud Platform (GCP)',
            'SQL', 'MySQL', 'PostgreSQL', 'SQLite', 'MongoDB', 'Redis', 'Elasticsearch',
            'GraphQL', 'REST API', 'gRPC', 'WebSockets',
            'HTML', 'CSS', 'Tailwind CSS', 'Bootstrap', 'Sass',
            'Git', 'GitHub', 'GitLab', 'CI/CD', 'GitHub Actions',
            'Linux', 'Bash', 'Nginx', 'Apache', 'Terraform', 'Ansible', 'Prometheus', 'Grafana',
            'C++', 'C', 'Scala', 'Elixir', 'Phoenix', 'Haskell', 'Lua', 'R', 'MATLAB',
            'Assembly', 'Perl', 'Groovy', 'Objective-C',
            'Unity', 'Unreal Engine', 'Godot',
            'Selenium', 'Cypress', 'Playwright', 'Jest', 'PHPUnit', 'Pest',
            'React Native', 'Ionic', 'Electron',
            'Figma', 'Adobe XD', 'Jira', 'Trello', 'Slack', 'Discord',
            'Postman', 'Swagger', 'OpenAPI',
            'WebAssembly', 'OAuth', 'JWT', 'Firebase', 'Supabase', 'Vercel', 'Netlify',
            'Alpine.js', 'Livewire', 'Inertia.js', 'Filament', 'Statamic', 'WordPress', 'Shopify',
            'Hadoop', 'Spark', 'Hive', 'Snowflake', 'Databricks', 'Airflow', 'Tableau', 'Power BI',
            'Xcode', 'Android Studio', 'Wireshark', 'Metasploit', 'Burp Suite', 'Kali Linux',
            'OpenStack', 'DigitalOcean', 'Heroku', 'Linode',
            'Jenkins', 'CircleCI', 'Travis CI', 'Bitbucket Pipelines',
        ];

        foreach ($technologies as $tech) {
            Tag::findOrCreate($tech, 'technologies');
        }
    }

    public function down(): void
    {
        // We generally don't remove tags in down() as they might be linked to content now.
    }
};
