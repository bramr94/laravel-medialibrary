<?php

namespace Spatie\MediaLibrary\Tests\Feature\HasMediaTrait;

use Spatie\MediaLibrary\Tests\TestCase;

class HasMediaTest extends TestCase
{
    /** @test */
    public function it_returns_false_for_an_empty_collection()
    {
        $this->assertFalse($this->testModel->hasMedia());
    }

    /** @test */
    public function it_returns_true_for_a_non_empty_collection()
    {
        $this->testModel->addMedia($this->getTestJpg())->toMediaCollection();

        $this->assertTrue($this->testModel->hasMedia());
    }

    /** @test */
    public function it_returns_true_for_a_non_empty_collection_in_an_unsaved_model()
    {
        $this->testUnsavedModel->addMedia($this->getTestJpg())->toMediaCollection();

        $this->assertTrue($this->testUnsavedModel->hasMedia());
    }

    /** @test */
    public function it_returns_true_if_any_collection_is_not_empty()
    {
        $this->testModel->addMedia($this->getTestJpg())->toMediaCollection('images');

        $this->assertTrue($this->testModel->hasMedia('images'));
    }

    /** @test */
    public function it_returns_false_for_an_empty_named_collection()
    {
        $this->assertFalse($this->testModel->hasMedia('images'));
    }

    /** @test */
    public function it_returns_true_for_a_non_empty_named_collection()
    {
        $this->testModel->addMedia($this->getTestJpg())->toMediaCollection('images');

        $this->assertTrue($this->testModel->hasMedia('images'));
        $this->assertFalse($this->testModel->hasMedia('downloads'));
    }

    /** @test */
    public function it_will_not_return_null_on_empty_collection()
    {
        $this->assertEquals(0, $this->testModel->countMedia('images'));
    }

    /** @test */
    public function it_will_return_integer_on_non_empty_collection()
    {
        $this->testModel->addMedia($this->getTestJpg())->toMediaCollection('images');

        $this->assertEquals(1, $this->testModel->countMedia('images'));
    }
}
