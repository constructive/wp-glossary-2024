<?php

namespace Constructive\Glossary\Http;

use App\Repositories\GlossaryItemRepository;

class GlossaryTermsController
{
    public function index()
    {
        return (new GlossaryItemRepository)->all();
    }
}
