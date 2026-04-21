<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RedirectResponse;

class Home extends Controller
{
    // ---------------------------------------------------------------
    // Helpers required by this controller
    // ---------------------------------------------------------------
    protected $helpers = ['url', 'form'];

    // ---------------------------------------------------------------
    // GET /
    // ---------------------------------------------------------------
    public function index(): string
    {
        $content = $this->loadContent();

        return view('home/index', [
            'content' => $content,
            'title'   => $content['site']['title'] ?? 'IronPDF for C++',
            'flash'   => [
                'success' => session()->getFlashdata('success'),
                'error'   => session()->getFlashdata('error'),
            ],
        ]);
    }

    // ---------------------------------------------------------------
    // POST /signup
    // ---------------------------------------------------------------
    public function signup(): RedirectResponse
    {
        // Validate email at the boundary before any further processing
        $rules = [
            'email' => 'required|valid_email|max_length[254]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to('/')->with('error', 'Please enter a valid email address.');
        }

        $email = $this->request->getPost('email', FILTER_SANITIZE_EMAIL);

        /*
         * In a real application you would persist $email to a database
         * or forward it to a mailing-list provider.  Here we simply
         * acknowledge the submission.
         */
        log_message('info', 'Beta sign-up received for: ' . $email);

        return redirect()->to('/')->with('success', 'Thank you! We\'ll be in touch when beta access opens.');
    }

    // ---------------------------------------------------------------
    // Load the JSON data source
    // ---------------------------------------------------------------
    private function loadContent(): array
    {
        $dataPath = ROOTPATH . 'data/content.json';

        if (! file_exists($dataPath)) {
            log_message('error', 'content.json not found at: ' . $dataPath);
            return [];
        }

        $decoded = json_decode(file_get_contents($dataPath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'Failed to parse content.json: ' . json_last_error_msg());
            return [];
        }

        return $decoded;
    }
}
