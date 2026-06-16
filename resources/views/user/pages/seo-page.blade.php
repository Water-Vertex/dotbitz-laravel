@extends('user.layouts.app')

@section('content')
<div class="min-h-screen bg-white">
    <div class="seo-page-wrapper">

        {{-- ══ HERO ══ --}}
        <div class="seo-hero">
            <h1 class="seo-hero-title">{{ $record->focus_keyword }}</h1>
            @if($record->h1_heading)
                <p class="seo-hero-sub">{{ $record->h1_heading }}</p>
            @endif
        </div>

        {{-- ══ MAIN IMAGE ══ --}}
        @if($record->image)
            <div class="seo-main-image">
                <img src="{{ $record->image }}" alt="{{ $record->image_alt ?? '' }}">
                @if($record->image_alt)
                    <p class="seo-img-caption">{{ $record->image_alt }}</p>
                @endif
            </div>
        @endif

        {{-- ══ MAIN CONTENT ══ --}}
        @if($record->content)
            <div class="seo-prose seo-main-content">
                {!! $record->content !!}
            </div>
        @endif

        {{-- ══ SECTION 1: Image LEFT | Content RIGHT ══ --}}
        @if($record->image_left || $record->section_content_left)
            <div class="seo-divider"></div>
            <div class="seo-two-col">
                <div class="seo-col-img">
                    @if($record->image_left)
                        <img src="{{ $record->image_left }}" alt="{{ $record->image_left_alt ?? '' }}">
                        @if($record->image_left_alt)
                            <p class="seo-img-caption">{{ $record->image_left_alt }}</p>
                        @endif
                    @endif
                </div>
                <div class="seo-col-text seo-prose">
                    {!! $record->section_content_left !!}
                </div>
            </div>
        @endif

        {{-- ══ SECTION 2: Content LEFT | Image RIGHT ══ --}}
        @if($record->image_right || $record->section_content_right)
            <div class="seo-divider"></div>
            <div class="seo-two-col">
                <div class="seo-col-text seo-prose">
                    {!! $record->section_content_right !!}
                </div>
                <div class="seo-col-img">
                    @if($record->image_right)
                        <img src="{{ $record->image_right }}" alt="{{ $record->image_right_alt ?? '' }}">
                        @if($record->image_right_alt)
                            <p class="seo-img-caption">{{ $record->image_right_alt }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @endif

    </div>{{-- end seo-page-wrapper --}}
</div>{{-- end bg-white --}}


{{-- ══════════════════════════════════════════════════════
     FAQs Section
══════════════════════════════════════════════════════ --}}
@php
    $faqsArray = [];
    if (!empty($record->faqs)) {
        $raw = trim($record->faqs);
        $toparse = str_starts_with($raw, '[') ? $raw : '[' . $raw . ']';
        $toparse = preg_replace('/,\s*\]/', ']', $toparse);
        $decoded = json_decode($toparse, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded) && count($decoded)) {
            foreach (array_values($decoded) as $item) {
                if (is_array($item)) {
                    $q = $item['question'] ?? ($item['Question'] ?? ($item[0] ?? ''));
                    $a = $item['answer']   ?? ($item['Answer']   ?? ($item[1] ?? ''));
                    if ($q || $a) {
                        $faqsArray[] = ['question' => (string)$q, 'answer' => (string)$a];
                    }
                } elseif (is_string($item) && trim($item)) {
                    $faqsArray[] = ['question' => '', 'answer' => trim($item)];
                }
            }
        } elseif (str_contains($raw, '|')) {
            $parts = array_filter(array_map('trim', explode('|', $raw)));
            $chunks = array_values($parts);
            for ($i = 0; $i < count($chunks); $i += 2) {
                $faqsArray[] = ['question' => $chunks[$i] ?? '', 'answer' => $chunks[$i + 1] ?? ''];
            }
        } elseif (str_contains($raw, "\n")) {
            foreach (explode("\n", $raw) as $line) {
                $line = trim($line);
                if ($line) $faqsArray[] = ['question' => '', 'answer' => $line];
            }
        } else {
            $faqsArray[] = ['question' => '', 'answer' => $raw];
        }
    }
@endphp

@if(count($faqsArray) > 0)
{{-- py-120 ko hata kar pt-0 pb-5 kiya hai gap kam karne ke liye --}}
<div class="faq-area pt-0 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="faq-content wow fadeInUp" data-wow-delay=".25s">
                    <div class="site-heading mb-3">
                        <span class="site-title-tagline">
                            <i class="far fa-lightbulb-on"></i> FAQ's
                        </span>
                        <h2 class="site-title my-3">
                            Frequently <span class="text-gradient">Asked</span> Questions
                        </h2>
                    </div>
                    <p class="mb-4">Got Questions? We've Got Answers</p>
                </div>
            </div>

            @foreach($faqsArray as $faq)
            <div class="col-lg-6 mb-3">
                <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="seoFaqAccordion{{ $loop->index }}">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="seoHeading{{ $loop->index }}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#seoCollapse{{ $loop->index }}"
                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                <span><i class="far fa-question"></i></span>
                                {{ $faq['question'] ?: 'FAQ ' . $loop->iteration }}
                            </button>
                        </h2>
                        <div id="seoCollapse{{ $loop->index }}"
                             class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                             data-bs-parent="#seoFaqAccordion{{ $loop->index }}">
                            <div class="accordion-body">
                                {!! nl2br(e($faq['answer'])) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<style>
/* ═══════════════════════════════
   PAGE WRAPPER
═══════════════════════════════ */
.seo-page-wrapper {
    max-width: 900px;
    margin: 0 auto;
    padding: 56px 24px 20px; /* Bottom padding kam ki hai */
}

/* ═══════════════════════════════
   HERO
═══════════════════════════════ */
.seo-hero {
    text-align: center;
    margin-bottom: 48px;
}
.seo-hero-title {
    font-size: 2.6rem;
    font-weight: 800;
    color: #111827;
    line-height: 1.2;
    margin: 0 0 16px;
}
.seo-hero-sub {
    font-size: 1.1rem;
    color: #6b7280;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.7;
}

/* ═══════════════════════════════
   IMAGES
═══════════════════════════════ */
.seo-main-image { margin-bottom: 48px; }
.seo-main-image img,
.seo-col-img img {
    width: 100%;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    display: block;
}
.seo-img-caption {
    font-size: 0.78rem;
    color: #9ca3af;
    text-align: center;
    margin-top: 8px;
}

/* ═══════════════════════════════
   MAIN CONTENT
═══════════════════════════════ */
.seo-main-content { margin-bottom: 48px; }

/* ═══════════════════════════════
   DIVIDER
═══════════════════════════════ */
.seo-divider {
    height: 1px;
    background: #f3f4f6;
    margin: 0 0 48px;
}

/* ═══════════════════════════════
   TWO COLUMN GRID
═══════════════════════════════ */
.seo-two-col {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 48px;
    align-items: start;
    margin-bottom: 48px;
}

/* FAQ SPECIFIC FIX */
.faq-area {
    margin-top: -20px !important; /* Forcefully section ko upar lane ke liye */
}

@media (max-width: 680px) {
    .seo-two-col { grid-template-columns: 1fr; gap: 24px; }
    .seo-col-img  { order: 1; }
    .seo-col-text { order: 2; }
    .seo-hero-title { font-size: 1.8rem; }
}

/* ═══════════════════════════════
   PROSE TYPOGRAPHY
═══════════════════════════════ */
.seo-prose {
    color: #374151;
    line-height: 1.8;
    font-size: 0.97rem;
}
.seo-prose p      { margin: 0 0 1rem; }
.seo-prose h2     { font-size: 1.35rem; font-weight: 700; color: #111827; margin: 1.6rem 0 0.6rem; }
.seo-prose h3     { font-size: 1.1rem;  font-weight: 600; color: #1f2937; margin: 1.2rem 0 0.4rem; }
.seo-prose ul,
.seo-prose ol     { padding-left: 1.3rem; margin-bottom: 1rem; }
.seo-prose li     { margin-bottom: 0.35rem; }
.seo-prose strong { color: #111827; font-weight: 600; }
.seo-prose a      { color: #2563eb; text-decoration: underline; }
</style>
@endsection