<?php

namespace App\Http\Builders;

use App\Models\CalendarEvent;
use App\Models\Company;

Class CalendarBuilder {
    /**
     * @var array
     */
    protected $inputs;

    /**
     * User constructor.
     * @param array $inputs
     */
    public function __construct(array $inputs = [])
    {
        $this->inputs = $inputs;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->builder()->get();
    }

    /**
     * @return mixed
     */
    public function builder()
    {
        $builder = CalendarEvent::with('companies');

        if ($this->inputs['company_id']) {
            $builder->whereHas('companies', function ($query) {
                $query->where('companies.id', $this->inputs['company_id']);
            });
        }

        if ($this->inputs['month']) {
            $builder->whereMonth('event_at', $this->inputs['month']);
        }
        if ($this->inputs['year']) {
            $builder->whereYear('event_at', $this->inputs['year']);
        }

        return $builder;
    }
}
