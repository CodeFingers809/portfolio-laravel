<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalInfo;
use App\Models\Education;
use App\Models\SocialLink;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Award;
use App\Models\Certification;
use App\Models\Skill;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        PersonalInfo::truncate();
        Education::truncate();
        SocialLink::truncate();
        Experience::truncate();
        Project::truncate();
        Award::truncate();
        Certification::truncate();
        Skill::truncate();

        // Personal Info
        PersonalInfo::create([
            'name' => 'Ayush B. Bohra',
            'title' => 'AI Engineer • ML Researcher • Full Stack Developer',
            'email' => 'tech.ayushbohra@gmail.com',
            'mobile' => '+91-9082000297',
            'bio' => 'Passionate about building intelligent systems and solving complex problems with machine learning and full-stack development.',
            'location' => 'Mumbai, India',
        ]);

        // Education
        Education::create([
            'degree' => 'B.E.',
            'field_of_study' => 'Artificial Intelligence and Data Science',
            'institution' => 'Vivekananand Education Society\'s Institute of Technology',
            'location' => 'Mumbai, India',
            'start_date' => '2022',
            'end_date' => 'May 2026',
            'cgpa' => 7.902,
            'order' => 1,
        ]);

        // Social Links
        $socialLinks = [
            ['platform' => 'GitHub', 'url' => 'https://github.com/CodeFingers809', 'icon' => 'github', 'order' => 1],
            ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/ayush-bohra7/', 'icon' => 'linkedin', 'order' => 2],
            ['platform' => 'LeetCode', 'url' => 'https://leetcode.com/u/CodeFingers809/', 'icon' => 'code', 'order' => 3],
            ['platform' => 'Kaggle', 'url' => 'https://www.kaggle.com/ayushbohra123', 'icon' => 'trophy', 'order' => 4],
        ];
        foreach ($socialLinks as $link) {
            SocialLink::create($link);
        }

        // Experiences
        Experience::create([
            'title' => 'Machine Learning Research Intern',
            'organization' => 'VESIT - Artificial Intelligence and Data Science Department',
            'location' => 'Mumbai, India',
            'start_date' => 'May 2024',
            'end_date' => 'Dec 2024',
            'current' => false,
            'description' => 'Conducted research on efficient image captioning models for edge devices',
            'achievements' => [
                'Fine Tuned 4 computer vision models on NVIDIA Jetson Nano for efficient image captioning',
                'Benchmarked across 500+ test images with an 86% BLEU score',
                'Published findings and clear comparison in a Research Paper (Oswal, S., et al.)'
            ],
            'type' => 'work',
            'url' => 'https://drive.google.com/file/d/1LRYIww9Pwwl9ovFScPadbSFOniqDCNdF/view?usp=sharing',
            'order' => 1,
        ]);

        Experience::create([
            'title' => 'Sr. Secretary',
            'organization' => 'CSI-VESIT',
            'location' => 'Chembur, Mumbai',
            'start_date' => 'Jul 2025',
            'end_date' => null,
            'current' => true,
            'description' => 'Leading technical initiatives and organizational activities for CSI-VESIT student chapter',
            'achievements' => [],
            'type' => 'leadership',
            'order' => 2,
        ]);

        Experience::create([
            'title' => 'Sr. Web-Tech Officer',
            'organization' => 'CSI-VESIT',
            'location' => 'Chembur, Mumbai',
            'start_date' => 'Aug 2024',
            'end_date' => 'Jul 2025',
            'current' => false,
            'description' => 'Managed web development projects and technical infrastructure',
            'achievements' => [],
            'type' => 'leadership',
            'order' => 3,
        ]);

        Experience::create([
            'title' => 'Junior Web Editor',
            'organization' => 'CSI-VESIT',
            'location' => 'Chembur, Mumbai',
            'start_date' => 'Oct 2023',
            'end_date' => 'Jul 2024',
            'current' => false,
            'description' => 'Contributed to web development and content management',
            'achievements' => [],
            'type' => 'leadership',
            'order' => 4,
        ]);

        Experience::create([
            'title' => 'Jr. Technical Officer',
            'organization' => 'AI Colegion',
            'location' => 'Chembur, Mumbai',
            'start_date' => 'Aug 2023',
            'end_date' => 'May 2024',
            'current' => false,
            'description' => 'Supported technical projects and initiatives in AI and machine learning',
            'achievements' => [],
            'type' => 'leadership',
            'order' => 5,
        ]);

        Experience::create([
            'title' => 'Technical Co-Head',
            'organization' => 'S.C.O.P.E Committee',
            'location' => 'Chembur, Mumbai',
            'start_date' => 'Aug 2021',
            'end_date' => 'Mar 2022',
            'current' => false,
            'description' => 'Co-led technical activities and events for the committee',
            'achievements' => [],
            'type' => 'leadership',
            'order' => 6,
        ]);

        // Projects
        Project::create([
            'title' => 'Transformer Architecture From Scratch',
            'description' => 'Constructed "Attention is all you need" architecture from scratch using PyTorch',
            'tech_stack' => ['PyTorch', 'Kaggle', 'Jupyter', 'Hugging Face'],
            'achievements' => [
                'Scaled to 2 Billion parameters with 512-token sequence length',
                'Trained on 14K+ English-Italian sentences from Opus dataset with 81.2% BLEU score'
            ],
            'github_url' => 'https://github.com/CodeFingers809/from-scratch-transformer',
            'featured' => true,
            'order' => 1,
        ]);

        Project::create([
            'title' => 'Vocal Pathology System',
            'description' => 'Voice pathology detection system with AI-generated medical reports',
            'tech_stack' => ['Flask', 'ReactJS', 'MongoDB', 'PyTorch', 'Twilio'],
            'achievements' => [
                'Built voice pathology detection system with 94% accuracy for vocal disorder identification',
                'Designed AI medical reports using DeepSeek-R1, reducing diagnosis time from days to minutes'
            ],
            'github_url' => 'https://github.com/CodeFingers809/audihealth',
            'featured' => true,
            'order' => 2,
        ]);

        Project::create([
            'title' => 'QRIYA',
            'description' => 'Stock market analysis and portfolio optimization platform using causal relationships',
            'tech_stack' => ['Flask', 'NextJS', 'ShadCN', 'AWS'],
            'achievements' => [
                'Computed causal relationships between all stocks on the NSE using Granger Causality leading to 4.4 Million total relationships',
                'Optimized portfolios using Hierarchical Risk Parity and Efficient Frontier',
                'Built a News Engine using AWS'
            ],
            'github_url' => 'https://github.com/CodeFingers809/audihealth',
            'featured' => true,
            'order' => 3,
        ]);

        Project::create([
            'title' => 'Brain Oscillation Mapping',
            'description' => 'Deep learning models for iEEG analysis with cognitive state prediction',
            'tech_stack' => ['PyTorch', 'PyTorch Geometric', 'Networkx', 'Matplotlib', 'Seaborn'],
            'achievements' => [
                'Implemented STGCN with Graph Attention Layers, improving temporal and spatial feature extraction',
                'Architected deep learning models for iEEG analysis with 83% cognitive state prediction accuracy'
            ],
            'github_url' => 'https://github.com/CodeFingers809',
            'featured' => false,
            'order' => 4,
        ]);

        // Awards
        Award::create([
            'title' => 'AMD AI Sprint Hackathon',
            'position' => '1st Place',
            'organization' => 'AMD',
            'date' => '2024',
            'description' => 'Built AI solution using AMD hardware acceleration',
            'order' => 1,
        ]);

        Award::create([
            'title' => 'HackPrix Season 2',
            'position' => '3rd Place',
            'organization' => 'HackPrix',
            'date' => '2024',
            'description' => 'Innovation hackathon',
            'order' => 2,
        ]);

        Award::create([
            'title' => 'KJSSE Gajshield Hack 8',
            'position' => '1st Place',
            'organization' => 'K J Somaiya',
            'date' => '2024',
            'description' => 'Cybersecurity focused hackathon',
            'order' => 3,
        ]);

        Award::create([
            'title' => 'The Great Bengaluru Hackathon',
            'position' => '1st Place',
            'organization' => 'Karnataka Government',
            'date' => '2024',
            'description' => 'Won first place in healthcare track',
            'order' => 4,
        ]);

        Award::create([
            'title' => 'HackTU 6.0',
            'position' => '1st Place',
            'organization' => 'MLH Hackathon',
            'date' => '2024',
            'description' => 'Major League Hacking event winner',
            'order' => 5,
        ]);

        Award::create([
            'title' => 'Dalal Street',
            'position' => '1st Place',
            'organization' => 'College Finance Fest',
            'date' => '2023',
            'description' => 'Stock market simulation competition',
            'order' => 6,
        ]);

        Award::create([
            'title' => 'Datathon 2025',
            'position' => '1st Place',
            'organization' => 'DataCon',
            'date' => '2025',
            'description' => 'Data science competition',
            'order' => 7,
        ]);

        // Certifications
        $certifications = [
            [
                'title' => 'AWS Academy Cloud Foundations',
                'issuer' => 'AWS',
                'date' => '2024',
                'url' => 'https://www.credly.com/badges/11c49b3d-83b5-4812-9e82-03178ae4045f/public_url',
                'order' => 1,
            ],
            [
                'title' => 'Generative AI Certified Professional',
                'issuer' => 'Oracle',
                'date' => '2024',
                'url' => 'https://catalog-education.oracle.com/pls/certview/sharebadge?id=5A50E4DF76E1E55390593744F2194FA42AC0D2155D6F562F69657F3B39AE3A20',
                'order' => 2,
            ],
            [
                'title' => 'Machine Learning Specialization',
                'issuer' => 'Stanford Online',
                'date' => '2023',
                'url' => 'https://www.coursera.org/account/accomplishments/specialization/UYN2VK3UR6VL',
                'order' => 3,
            ],
            [
                'title' => 'Transformer Models and BERT Model',
                'issuer' => 'Google Cloud',
                'date' => '2024',
                'url' => 'https://coursera.org/share/3905a8616f30d670fd92b2ff78241d59',
                'order' => 4,
            ],
            [
                'title' => 'Applications of AI for Predictive Maintenance',
                'issuer' => 'NVIDIA',
                'date' => '2023',
                'url' => 'https://courses.nvidia.com/certificates/ab451ad878a142c8a1eaf9f84f31fc77/',
                'order' => 5,
            ],
            [
                'title' => 'Applications of AI for Anomaly Detection',
                'issuer' => 'NVIDIA',
                'date' => '2023',
                'url' => 'https://courses.nvidia.com/certificates/8c847f134fd44ba9852830f6f22fe921/',
                'order' => 6,
            ],
            [
                'title' => 'Fundamentals of Deep Learning',
                'issuer' => 'NVIDIA',
                'date' => '2023',
                'url' => 'https://courses.nvidia.com/certificates/1ac86ff551f84e54a842400aad798876/',
                'order' => 7,
            ],
        ];

        foreach ($certifications as $cert) {
            Certification::create($cert);
        }

        // Skills
        $skills = [
            // AI & Data Science
            ['name' => 'PyTorch', 'category' => 'AI & Data Science', 'proficiency' => 95, 'order' => 1],
            ['name' => 'TensorFlow', 'category' => 'AI & Data Science', 'proficiency' => 90, 'order' => 2],
            ['name' => 'Pandas', 'category' => 'AI & Data Science', 'proficiency' => 92, 'order' => 3],
            ['name' => 'Numpy', 'category' => 'AI & Data Science', 'proficiency' => 92, 'order' => 4],
            ['name' => 'Sci-Kit Learn', 'category' => 'AI & Data Science', 'proficiency' => 88, 'order' => 5],
            ['name' => 'Matplotlib', 'category' => 'AI & Data Science', 'proficiency' => 85, 'order' => 6],
            ['name' => 'Seaborn', 'category' => 'AI & Data Science', 'proficiency' => 85, 'order' => 7],
            ['name' => 'Transformers', 'category' => 'AI & Data Science', 'proficiency' => 90, 'order' => 8],
            ['name' => 'MongoDB', 'category' => 'AI & Data Science', 'proficiency' => 85, 'order' => 9],
            ['name' => 'SQL', 'category' => 'AI & Data Science', 'proficiency' => 80, 'order' => 10],
            ['name' => 'Hadoop', 'category' => 'AI & Data Science', 'proficiency' => 75, 'order' => 11],

            // Development
            ['name' => 'ReactJS', 'category' => 'Development', 'proficiency' => 88, 'order' => 12],
            ['name' => 'TailwindCSS', 'category' => 'Development', 'proficiency' => 90, 'order' => 13],
            ['name' => 'Flask', 'category' => 'Development', 'proficiency' => 85, 'order' => 14],
            ['name' => 'REST APIs', 'category' => 'Development', 'proficiency' => 87, 'order' => 15],
            ['name' => 'Web Sockets', 'category' => 'Development', 'proficiency' => 80, 'order' => 16],
            ['name' => 'PHP', 'category' => 'Development', 'proficiency' => 78, 'order' => 17],
            ['name' => 'Laravel', 'category' => 'Development', 'proficiency' => 80, 'order' => 18],

            // Tools and Libraries
            ['name' => 'Git', 'category' => 'Tools and Libraries', 'proficiency' => 92, 'order' => 19],
            ['name' => 'GitHub', 'category' => 'Tools and Libraries', 'proficiency' => 92, 'order' => 20],
            ['name' => 'HuggingFace', 'category' => 'Tools and Libraries', 'proficiency' => 88, 'order' => 21],
            ['name' => 'NVIDIA Jetson Nano', 'category' => 'Tools and Libraries', 'proficiency' => 85, 'order' => 22],
            ['name' => 'Jupyter', 'category' => 'Tools and Libraries', 'proficiency' => 90, 'order' => 23],
            ['name' => 'Google Colab', 'category' => 'Tools and Libraries', 'proficiency' => 90, 'order' => 24],
            ['name' => 'Kaggle', 'category' => 'Tools and Libraries', 'proficiency' => 88, 'order' => 25],
            ['name' => 'FileZilla', 'category' => 'Tools and Libraries', 'proficiency' => 80, 'order' => 26],
            ['name' => 'phpMyAdmin', 'category' => 'Tools and Libraries', 'proficiency' => 80, 'order' => 27],
            ['name' => 'Hostinger', 'category' => 'Tools and Libraries', 'proficiency' => 75, 'order' => 28],
            ['name' => 'Linux', 'category' => 'Tools and Libraries', 'proficiency' => 85, 'order' => 29],
            ['name' => 'Bash', 'category' => 'Tools and Libraries', 'proficiency' => 82, 'order' => 30],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
