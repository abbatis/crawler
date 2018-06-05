<?php

namespace Spatie\Crawler;

use Spatie\Robots\RobotsTxt;
use Psr\Http\Message\UriInterface;
use Spatie\Browsershot\Browsershot;
use Spatie\Crawler\CrawlQueue\CrawlQueue;

trait CrawlerProperties
{
    public function setConcurrency(int $concurrency): self
    {
        $this->concurrency = $concurrency;

        return $this;
    }

    public function setMaximumResponseSize(int $maximumResponseSizeInBytes): self
    {
        $this->maximumResponseSize = $maximumResponseSizeInBytes;

        return $this;
    }

    public function getMaximumResponseSize(): ?int
    {
        return $this->maximumResponseSize;
    }

    public function setMaximumCrawlCount(int $maximumCrawlCount): self
    {
        $this->maximumCrawlCount = $maximumCrawlCount;

        return $this;
    }

    public function getMaximumCrawlCount(): ?int
    {
        return $this->maximumCrawlCount;
    }

    public function getCrawlerUrlCount(): int
    {
        return $this->crawledUrlCount;
    }

    public function setMaximumDepth(int $maximumDepth): self
    {
        $this->maximumDepth = $maximumDepth;

        return $this;
    }

    public function getMaximumDepth(): ?int
    {
        return $this->maximumDepth;
    }

    public function ignoreRobots(): self
    {
        $this->respectRobots = false;

        return $this;
    }

    public function respectRobots(): self
    {
        $this->respectRobots = true;

        return $this;
    }

    public function mustRespectRobots(): bool
    {
        return $this->respectRobots;
    }

    public function getRobotsTxt(): RobotsTxt
    {
        return $this->robotsTxt;
    }

    public function setCrawlQueue(CrawlQueue $crawlQueue): self
    {
        $this->crawlQueue = $crawlQueue;

        return $this;
    }

    public function getCrawlQueue(): CrawlQueue
    {
        return $this->crawlQueue;
    }

    public function executeJavaScript(): self
    {
        $this->executeJavaScript = true;

        return $this;
    }

    public function doNotExecuteJavaScript(): self
    {
        $this->executeJavaScript = false;

        return $this;
    }

    public function mayExecuteJavascript(): bool
    {
        return $this->executeJavaScript;
    }

    /**
     * @param \Spatie\Crawler\CrawlObserver|array[\Spatie\Crawler\CrawlObserver] $crawlObservers
     *
     * @return $this
     */
    public function setCrawlObserver($crawlObservers): self
    {
        if (! is_array($crawlObservers)) {
            $crawlObservers = [$crawlObservers];
        }

        return $this->setCrawlObservers($crawlObservers);
    }

    public function setCrawlObservers(array $crawlObservers): self
    {
        $this->crawlObservers = new ObserverCollection($crawlObservers);

        return $this;
    }

    public function addCrawlObserver(CrawlObserver $crawlObserver): self
    {
        $this->crawlObservers->addObserver($crawlObserver);

        return $this;
    }

    public function getCrawlObservers(): ObserverCollection
    {
        return $this->crawlObservers;
    }

    public function setCrawlProfile(CrawlProfile $crawlProfile): self
    {
        $this->crawlProfile = $crawlProfile;

        return $this;
    }

    public function getCrawlProfile(): CrawlProfile
    {
        return $this->crawlProfile;
    }

    public function setBrowsershot(Browsershot $browsershot)
    {
        $this->browsershot = $browsershot;

        return $this;
    }

    public function getBrowsershot(): Browsershot
    {
        if (! $this->browsershot) {
            $this->browsershot = new Browsershot();
        }

        return $this->browsershot;
    }

    public function getBaseUrl(): UriInterface
    {
        return $this->baseUrl;
    }
}