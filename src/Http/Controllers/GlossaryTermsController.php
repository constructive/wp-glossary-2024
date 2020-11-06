<?php

namespace Constructive\Glossary\Http\Controllers;

use Constructive\Glossary\Repositories\GlossaryItemRepository;

class GlossaryTermsController
{
    public function index()
    {
        return (new GlossaryItemRepository)->all();
    }
}
