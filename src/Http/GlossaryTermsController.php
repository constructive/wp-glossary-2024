<?php

namespace App\Glossary\Http;

use App\Glossary\Repositories\GlossaryItemRepository;

class GlossaryTermsController
{
    public function index()
    {
        return (new GlossaryItemRepository)->all();
    }
}
