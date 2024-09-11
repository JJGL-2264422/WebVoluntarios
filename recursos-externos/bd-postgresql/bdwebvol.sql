--
-- PostgreSQL database dump
--

-- Dumped from database version 16.4
-- Dumped by pg_dump version 16.4

-- Started on 2024-09-10 19:02:52

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE IF EXISTS bdwebvol;
--
-- TOC entry 4811 (class 1262 OID 16396)
-- Name: bdwebvol; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE bdwebvol WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Spanish_Colombia.1252';


ALTER DATABASE bdwebvol OWNER TO postgres;

\connect bdwebvol

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 215 (class 1259 OID 16410)
-- Name: actividades; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.actividades (
    codigo text NOT NULL,
    titulo text NOT NULL,
    descripcion text,
    creador_id text NOT NULL,
    inicia_en timestamp with time zone NOT NULL,
    termina_en timestamp with time zone NOT NULL,
    ubicacion text NOT NULL
);


ALTER TABLE public.actividades OWNER TO postgres;

--
-- TOC entry 217 (class 1259 OID 16423)
-- Name: registros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registros (
    id bigint NOT NULL,
    usuario_id text NOT NULL,
    codigo_actividad text NOT NULL,
    tiempo_registro timestamp with time zone DEFAULT now()
);


ALTER TABLE public.registros OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16422)
-- Name: registrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.registros ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.registrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- TOC entry 218 (class 1259 OID 16443)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    username text NOT NULL,
    password text NOT NULL,
    nombre text NOT NULL,
    apellido text NOT NULL,
    email text NOT NULL,
    "compañia" text,
    rol text NOT NULL,
    habilidades text,
    imagen_perfil text
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- TOC entry 4802 (class 0 OID 16410)
-- Dependencies: 215
-- Data for Name: actividades; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4804 (class 0 OID 16423)
-- Dependencies: 217
-- Data for Name: registros; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4805 (class 0 OID 16443)
-- Dependencies: 218
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 4812 (class 0 OID 0)
-- Dependencies: 216
-- Name: registrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.registrations_id_seq', 1, false);


--
-- TOC entry 4645 (class 2606 OID 16416)
-- Name: actividades activities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividades
    ADD CONSTRAINT activities_pkey PRIMARY KEY (codigo);


--
-- TOC entry 4647 (class 2606 OID 16430)
-- Name: registros registrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registros
    ADD CONSTRAINT registrations_pkey PRIMARY KEY (id);


--
-- TOC entry 4649 (class 2606 OID 16475)
-- Name: registros registrations_user_id_activity_code_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registros
    ADD CONSTRAINT registrations_user_id_activity_code_key UNIQUE (usuario_id, codigo_actividad);


--
-- TOC entry 4643 (class 2606 OID 16494)
-- Name: usuarios users_role_check; Type: CHECK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE public.usuarios
    ADD CONSTRAINT users_role_check CHECK ((rol = ANY (ARRAY['manager'::text, 'voluntario'::text, 'administrador'::text]))) NOT VALID;


--
-- TOC entry 4651 (class 2606 OID 16454)
-- Name: usuarios users_temp_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT users_temp_email_key UNIQUE (email);


--
-- TOC entry 4653 (class 2606 OID 16452)
-- Name: usuarios users_temp_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT users_temp_username_key UNIQUE (username);


--
-- TOC entry 4655 (class 2606 OID 16467)
-- Name: usuarios usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (username);


--
-- TOC entry 4656 (class 2606 OID 16483)
-- Name: actividades activities_creator_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.actividades
    ADD CONSTRAINT activities_creator_id_fkey FOREIGN KEY (creador_id) REFERENCES public.usuarios(username);


--
-- TOC entry 4657 (class 2606 OID 16438)
-- Name: registros registrations_activity_code_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registros
    ADD CONSTRAINT registrations_activity_code_fkey FOREIGN KEY (codigo_actividad) REFERENCES public.actividades(codigo);


--
-- TOC entry 4658 (class 2606 OID 16488)
-- Name: registros registrations_user_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registros
    ADD CONSTRAINT registrations_user_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.usuarios(username);


-- Completed on 2024-09-10 19:02:52

--
-- PostgreSQL database dump complete
--

