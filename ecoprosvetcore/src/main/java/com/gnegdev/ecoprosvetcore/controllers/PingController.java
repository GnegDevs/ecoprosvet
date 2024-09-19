package com.gnegdev.ecoprosvetcore.controllers;

import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("ecocore/api/v1/ping")
public class PingController {

    @GetMapping()
    @ResponseStatus(HttpStatus.OK)
    public String ping() {
        return "ok";
    }

}

