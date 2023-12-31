PGDMP     5    '            	    {         
   globaltvdb    12.14    12.14 �    �           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            �           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            �           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            �           1262    180616 
   globaltvdb    DATABASE     �   CREATE DATABASE globaltvdb WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'French_France.1252' LC_CTYPE = 'French_France.1252';
    DROP DATABASE globaltvdb;
                globaltvuser    false                       1259    319949    advertizing_pub_zones    TABLE     f  CREATE TABLE public.advertizing_pub_zones (
    id integer NOT NULL,
    author integer NOT NULL,
    advertizing bigint NOT NULL,
    zone bigint NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    valid_by integer,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 )   DROP TABLE public.advertizing_pub_zones;
       public         heap    globaltvuser    false                       1259    319947    advertizing_pub_zones_id_seq    SEQUENCE     �   CREATE SEQUENCE public.advertizing_pub_zones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 3   DROP SEQUENCE public.advertizing_pub_zones_id_seq;
       public          globaltvuser    false    262            �           0    0    advertizing_pub_zones_id_seq    SEQUENCE OWNED BY     ]   ALTER SEQUENCE public.advertizing_pub_zones_id_seq OWNED BY public.advertizing_pub_zones.id;
          public          globaltvuser    false    261            �            1259    180917    advertizings    TABLE        CREATE TABLE public.advertizings (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    resume text NOT NULL,
    date_start date NOT NULL,
    date_end date NOT NULL,
    cover character varying(255) NOT NULL,
    video character varying(255) NOT NULL,
    is_video integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
     DROP TABLE public.advertizings;
       public         heap    globaltvuser    false            �            1259    180915    advertizings_id_seq    SEQUENCE     �   CREATE SEQUENCE public.advertizings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.advertizings_id_seq;
       public          globaltvuser    false    236            �           0    0    advertizings_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.advertizings_id_seq OWNED BY public.advertizings.id;
          public          globaltvuser    false    235            �            1259    180782    banners    TABLE     �  CREATE TABLE public.banners (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    label character varying(255),
    description text NOT NULL,
    cover character varying(255) NOT NULL,
    link character varying(255),
    valid_by integer,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.banners;
       public         heap    globaltvuser    false            �            1259    180780    banners_id_seq    SEQUENCE     �   CREATE SEQUENCE public.banners_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.banners_id_seq;
       public          globaltvuser    false    224            �           0    0    banners_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.banners_id_seq OWNED BY public.banners.id;
          public          globaltvuser    false    223            �            1259    180805 
   categories    TABLE     +  CREATE TABLE public.categories (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.categories;
       public         heap    globaltvuser    false            �            1259    180803    categories_id_seq    SEQUENCE     �   CREATE SEQUENCE public.categories_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.categories_id_seq;
       public          globaltvuser    false    226            �           0    0    categories_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;
          public          globaltvuser    false    225            �            1259    180662    cities    TABLE     3  CREATE TABLE public.cities (
    id bigint NOT NULL,
    state_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT cities_status_check CHECK (((status)::text = ANY ((ARRAY['active'::character varying, 'inactive'::character varying])::text[])))
);
    DROP TABLE public.cities;
       public         heap    globaltvuser    false            �            1259    180660    cities_id_seq    SEQUENCE     v   CREATE SEQUENCE public.cities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.cities_id_seq;
       public          globaltvuser    false    209            �           0    0    cities_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.cities_id_seq OWNED BY public.cities.id;
          public          globaltvuser    false    208            �            1259    180979    comments    TABLE     E  CREATE TABLE public.comments (
    id integer NOT NULL,
    author integer NOT NULL,
    news bigint,
    replay bigint,
    podcast bigint,
    text text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    interview bigint
);
    DROP TABLE public.comments;
       public         heap    globaltvuser    false            �            1259    180977    comments_id_seq    SEQUENCE     �   CREATE SEQUENCE public.comments_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.comments_id_seq;
       public          globaltvuser    false    242            �           0    0    comments_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.comments_id_seq OWNED BY public.comments.id;
          public          globaltvuser    false    241            �            1259    181036 	   companies    TABLE     �  CREATE TABLE public.companies (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    vision text NOT NULL,
    objectif text NOT NULL,
    phone text NOT NULL,
    address text NOT NULL,
    email text NOT NULL,
    map text NOT NULL,
    logo character varying(255) NOT NULL,
    cover character varying(255),
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.companies;
       public         heap    globaltvuser    false            �            1259    181034    companies_id_seq    SEQUENCE     y   CREATE SEQUENCE public.companies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.companies_id_seq;
       public          globaltvuser    false    248            �           0    0    companies_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.companies_id_seq OWNED BY public.companies.id;
          public          globaltvuser    false    247            �            1259    180627 	   countries    TABLE       CREATE TABLE public.countries (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT countries_status_check CHECK (((status)::text = ANY ((ARRAY['active'::character varying, 'inactive'::character varying])::text[])))
);
    DROP TABLE public.countries;
       public         heap    globaltvuser    false            �            1259    180625    countries_id_seq    SEQUENCE     y   CREATE SEQUENCE public.countries_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.countries_id_seq;
       public          globaltvuser    false    205            �           0    0    countries_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.countries_id_seq OWNED BY public.countries.id;
          public          globaltvuser    false    204            �            1259    180754    failed_jobs    TABLE     &  CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    globaltvuser    false            �            1259    180752    failed_jobs_id_seq    SEQUENCE     {   CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.failed_jobs_id_seq;
       public          globaltvuser    false    220            �           0    0    failed_jobs_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;
          public          globaltvuser    false    219            �            1259    180868 
   interviews    TABLE     �  CREATE TABLE public.interviews (
    id integer NOT NULL,
    author integer NOT NULL,
    program bigint NOT NULL,
    category bigint NOT NULL,
    country bigint NOT NULL,
    title character varying(255) NOT NULL,
    label character varying(255),
    description text NOT NULL,
    cover character varying(255) NOT NULL,
    video character varying(255),
    is_video integer DEFAULT 1 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    priority integer DEFAULT 5 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.interviews;
       public         heap    globaltvuser    false            �            1259    180866    interviews_id_seq    SEQUENCE     �   CREATE SEQUENCE public.interviews_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.interviews_id_seq;
       public          globaltvuser    false    232            �           0    0    interviews_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.interviews_id_seq OWNED BY public.interviews.id;
          public          globaltvuser    false    231            �            1259    180964    likes    TABLE     R  CREATE TABLE public.likes (
    id integer NOT NULL,
    author integer NOT NULL,
    news bigint,
    replay bigint,
    podcast bigint,
    is_like integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    interview bigint
);
    DROP TABLE public.likes;
       public         heap    globaltvuser    false            �            1259    180962    likes_id_seq    SEQUENCE     �   CREATE SEQUENCE public.likes_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.likes_id_seq;
       public          globaltvuser    false    240            �           0    0    likes_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.likes_id_seq OWNED BY public.likes.id;
          public          globaltvuser    false    239            �            1259    181048    menus    TABLE     &  CREATE TABLE public.menus (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.menus;
       public         heap    globaltvuser    false            �            1259    181046    menus_id_seq    SEQUENCE     �   CREATE SEQUENCE public.menus_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.menus_id_seq;
       public          globaltvuser    false    250            �           0    0    menus_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.menus_id_seq OWNED BY public.menus.id;
          public          globaltvuser    false    249            �            1259    180619 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    globaltvuser    false            �            1259    180617    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          globaltvuser    false    203            �           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          globaltvuser    false    202            �            1259    181011    news    TABLE     W  CREATE TABLE public.news (
    id integer NOT NULL,
    author integer NOT NULL,
    category bigint NOT NULL,
    country bigint NOT NULL,
    title character varying(255) NOT NULL,
    label character varying(255),
    description text NOT NULL,
    cover character varying(255),
    video character varying(255),
    is_video integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    priority integer DEFAULT 0 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.news;
       public         heap    globaltvuser    false            �            1259    181009    news_id_seq    SEQUENCE     �   CREATE SEQUENCE public.news_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.news_id_seq;
       public          globaltvuser    false    246            �           0    0    news_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;
          public          globaltvuser    false    245            �            1259    180720    oauth_access_tokens    TABLE     b  CREATE TABLE public.oauth_access_tokens (
    id character varying(100) NOT NULL,
    user_id bigint,
    client_id uuid NOT NULL,
    name character varying(255),
    scopes text,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone
);
 '   DROP TABLE public.oauth_access_tokens;
       public         heap    globaltvuser    false            �            1259    180711    oauth_auth_codes    TABLE     �   CREATE TABLE public.oauth_auth_codes (
    id character varying(100) NOT NULL,
    user_id bigint NOT NULL,
    client_id uuid NOT NULL,
    scopes text,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);
 $   DROP TABLE public.oauth_auth_codes;
       public         heap    globaltvuser    false            �            1259    180735    oauth_clients    TABLE     �  CREATE TABLE public.oauth_clients (
    id uuid NOT NULL,
    user_id bigint,
    name character varying(255) NOT NULL,
    secret character varying(100),
    provider character varying(255),
    redirect text NOT NULL,
    personal_access_client boolean NOT NULL,
    password_client boolean NOT NULL,
    revoked boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 !   DROP TABLE public.oauth_clients;
       public         heap    globaltvuser    false            �            1259    180746    oauth_personal_access_clients    TABLE     �   CREATE TABLE public.oauth_personal_access_clients (
    id bigint NOT NULL,
    client_id uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 1   DROP TABLE public.oauth_personal_access_clients;
       public         heap    globaltvuser    false            �            1259    180744 $   oauth_personal_access_clients_id_seq    SEQUENCE     �   CREATE SEQUENCE public.oauth_personal_access_clients_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 ;   DROP SEQUENCE public.oauth_personal_access_clients_id_seq;
       public          globaltvuser    false    218            �           0    0 $   oauth_personal_access_clients_id_seq    SEQUENCE OWNED BY     m   ALTER SEQUENCE public.oauth_personal_access_clients_id_seq OWNED BY public.oauth_personal_access_clients.id;
          public          globaltvuser    false    217            �            1259    180729    oauth_refresh_tokens    TABLE     �   CREATE TABLE public.oauth_refresh_tokens (
    id character varying(100) NOT NULL,
    access_token_id character varying(100) NOT NULL,
    revoked boolean NOT NULL,
    expires_at timestamp(0) without time zone
);
 (   DROP TABLE public.oauth_refresh_tokens;
       public         heap    globaltvuser    false            �            1259    180704    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         heap    globaltvuser    false            �            1259    180768    personal_access_tokens    TABLE     �  CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 *   DROP TABLE public.personal_access_tokens;
       public         heap    globaltvuser    false            �            1259    180766    personal_access_tokens_id_seq    SEQUENCE     �   CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 4   DROP SEQUENCE public.personal_access_tokens_id_seq;
       public          globaltvuser    false    222            �           0    0    personal_access_tokens_id_seq    SEQUENCE OWNED BY     _   ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;
          public          globaltvuser    false    221            �            1259    180893    podcasts    TABLE     :  CREATE TABLE public.podcasts (
    id integer NOT NULL,
    author integer NOT NULL,
    advertizing bigint,
    program bigint NOT NULL,
    title character varying(255) NOT NULL,
    label character varying(255),
    description text NOT NULL,
    cover character varying(255) NOT NULL,
    audio character varying(255),
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    is_sponsoring integer DEFAULT 0 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.podcasts;
       public         heap    globaltvuser    false            �            1259    180891    podcasts_id_seq    SEQUENCE     �   CREATE SEQUENCE public.podcasts_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.podcasts_id_seq;
       public          globaltvuser    false    234            �           0    0    podcasts_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.podcasts_id_seq OWNED BY public.podcasts.id;
          public          globaltvuser    false    233            �            1259    180822    programs    TABLE     &  CREATE TABLE public.programs (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    cover character varying(255) NOT NULL,
    time_start time(0) without time zone NOT NULL,
    time_end time(0) without time zone NOT NULL,
    date date NOT NULL,
    day text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.programs;
       public         heap    globaltvuser    false            �            1259    180820    programs_id_seq    SEQUENCE     �   CREATE SEQUENCE public.programs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.programs_id_seq;
       public          globaltvuser    false    228            �           0    0    programs_id_seq    SEQUENCE OWNED BY     C   ALTER SEQUENCE public.programs_id_seq OWNED BY public.programs.id;
          public          globaltvuser    false    227                       1259    319932 	   pub_zones    TABLE     #  CREATE TABLE public.pub_zones (
    id integer NOT NULL,
    author integer NOT NULL,
    title text NOT NULL,
    code character varying(255) NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.pub_zones;
       public         heap    globaltvuser    false                       1259    319930    pub_zones_id_seq    SEQUENCE     �   CREATE SEQUENCE public.pub_zones_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.pub_zones_id_seq;
       public          globaltvuser    false    260            �           0    0    pub_zones_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.pub_zones_id_seq OWNED BY public.pub_zones.id;
          public          globaltvuser    false    259            �            1259    180941    replays    TABLE       CREATE TABLE public.replays (
    id integer NOT NULL,
    author integer NOT NULL,
    program bigint NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    cover character varying(255) NOT NULL,
    video character varying(255) NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    is_video integer DEFAULT 1 NOT NULL
);
    DROP TABLE public.replays;
       public         heap    globaltvuser    false            �            1259    180939    replays_id_seq    SEQUENCE     �   CREATE SEQUENCE public.replays_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.replays_id_seq;
       public          globaltvuser    false    238            �           0    0    replays_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.replays_id_seq OWNED BY public.replays.id;
          public          globaltvuser    false    237            �            1259    181087 
   rule_menus    TABLE     d  CREATE TABLE public.rule_menus (
    id integer NOT NULL,
    author integer NOT NULL,
    menu integer NOT NULL,
    submenu integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.rule_menus;
       public         heap    globaltvuser    false            �            1259    181085    rule_menus_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rule_menus_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.rule_menus_id_seq;
       public          globaltvuser    false    254            �           0    0    rule_menus_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.rule_menus_id_seq OWNED BY public.rule_menus.id;
          public          globaltvuser    false    253                        1259    181114 
   rule_users    TABLE     c  CREATE TABLE public.rule_users (
    id integer NOT NULL,
    author integer NOT NULL,
    "user" integer NOT NULL,
    rule integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.rule_users;
       public         heap    globaltvuser    false            �            1259    181112    rule_users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.rule_users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.rule_users_id_seq;
       public          globaltvuser    false    256            �           0    0    rule_users_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.rule_users_id_seq OWNED BY public.rule_users.id;
          public          globaltvuser    false    255                       1259    319881    seeings    TABLE     �  CREATE TABLE public.seeings (
    id integer NOT NULL,
    news bigint,
    replay bigint,
    podcast bigint,
    advertizing bigint,
    info_user text NOT NULL,
    is_internal_user integer DEFAULT 0 NOT NULL,
    is_read integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.seeings;
       public         heap    globaltvuser    false                       1259    319879    seeings_id_seq    SEQUENCE     �   CREATE SEQUENCE public.seeings_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.seeings_id_seq;
       public          globaltvuser    false    258            �           0    0    seeings_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.seeings_id_seq OWNED BY public.seeings.id;
          public          globaltvuser    false    257            �            1259    180996    shares    TABLE     `  CREATE TABLE public.shares (
    id integer NOT NULL,
    author integer NOT NULL,
    news bigint,
    replay bigint,
    podcast bigint,
    socialmedia integer NOT NULL,
    is_share integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.shares;
       public         heap    globaltvuser    false            �            1259    180994    shares_id_seq    SEQUENCE     �   CREATE SEQUENCE public.shares_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.shares_id_seq;
       public          globaltvuser    false    244            �           0    0    shares_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.shares_id_seq OWNED BY public.shares.id;
          public          globaltvuser    false    243            �            1259    180642    states    TABLE     5  CREATE TABLE public.states (
    id bigint NOT NULL,
    country_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'active'::character varying NOT NULL,
    created_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    updated_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT states_status_check CHECK (((status)::text = ANY ((ARRAY['active'::character varying, 'inactive'::character varying])::text[])))
);
    DROP TABLE public.states;
       public         heap    globaltvuser    false            �            1259    180640    states_id_seq    SEQUENCE     v   CREATE SEQUENCE public.states_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.states_id_seq;
       public          globaltvuser    false    207            �           0    0    states_id_seq    SEQUENCE OWNED BY     ?   ALTER SEQUENCE public.states_id_seq OWNED BY public.states.id;
          public          globaltvuser    false    206            �            1259    180845    streams    TABLE     �  CREATE TABLE public.streams (
    id integer NOT NULL,
    author integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    link character varying(255) NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    is_valid integer DEFAULT 0 NOT NULL,
    valid_by integer,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.streams;
       public         heap    globaltvuser    false            �            1259    180843    streams_id_seq    SEQUENCE     �   CREATE SEQUENCE public.streams_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.streams_id_seq;
       public          globaltvuser    false    230            �           0    0    streams_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.streams_id_seq OWNED BY public.streams.id;
          public          globaltvuser    false    229            �            1259    181065 	   sub_menus    TABLE     E  CREATE TABLE public.sub_menus (
    id integer NOT NULL,
    author integer NOT NULL,
    menu integer NOT NULL,
    title character varying(255) NOT NULL,
    description text NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.sub_menus;
       public         heap    globaltvuser    false            �            1259    181063    sub_menus_id_seq    SEQUENCE     �   CREATE SEQUENCE public.sub_menus_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 '   DROP SEQUENCE public.sub_menus_id_seq;
       public          globaltvuser    false    252            �           0    0    sub_menus_id_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.sub_menus_id_seq OWNED BY public.sub_menus.id;
          public          globaltvuser    false    251            �            1259    180682    users    TABLE     �  CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone bigint NOT NULL,
    country bigint NOT NULL,
    state bigint NOT NULL,
    city bigint NOT NULL,
    address character varying(255) NOT NULL,
    pp character varying(255) DEFAULT 'default_pp.png'::character varying NOT NULL,
    cover character varying(255) DEFAULT 'default_pp.png'::character varying NOT NULL,
    password character varying(255) NOT NULL,
    is_superadmin integer DEFAULT 0 NOT NULL,
    is_admin integer DEFAULT 0 NOT NULL,
    is_apiuser integer DEFAULT 0 NOT NULL,
    is_staff integer DEFAULT 0 NOT NULL,
    is_agent integer DEFAULT 0 NOT NULL,
    is_api integer DEFAULT 0 NOT NULL,
    is_active integer DEFAULT 1 NOT NULL,
    email_verified_at timestamp(0) without time zone,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         heap    globaltvuser    false            �            1259    180680    users_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public          globaltvuser    false    211            �           0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
          public          globaltvuser    false    210            �           2604    319952    advertizing_pub_zones id    DEFAULT     �   ALTER TABLE ONLY public.advertizing_pub_zones ALTER COLUMN id SET DEFAULT nextval('public.advertizing_pub_zones_id_seq'::regclass);
 G   ALTER TABLE public.advertizing_pub_zones ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    261    262    262            �           2604    180920    advertizings id    DEFAULT     r   ALTER TABLE ONLY public.advertizings ALTER COLUMN id SET DEFAULT nextval('public.advertizings_id_seq'::regclass);
 >   ALTER TABLE public.advertizings ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    236    235    236            n           2604    180785 
   banners id    DEFAULT     h   ALTER TABLE ONLY public.banners ALTER COLUMN id SET DEFAULT nextval('public.banners_id_seq'::regclass);
 9   ALTER TABLE public.banners ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    223    224    224            q           2604    180808    categories id    DEFAULT     n   ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);
 <   ALTER TABLE public.categories ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    225    226    226            [           2604    180665 	   cities id    DEFAULT     f   ALTER TABLE ONLY public.cities ALTER COLUMN id SET DEFAULT nextval('public.cities_id_seq'::regclass);
 8   ALTER TABLE public.cities ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    209    208    209            �           2604    180982    comments id    DEFAULT     j   ALTER TABLE ONLY public.comments ALTER COLUMN id SET DEFAULT nextval('public.comments_id_seq'::regclass);
 :   ALTER TABLE public.comments ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    242    241    242            �           2604    181039    companies id    DEFAULT     l   ALTER TABLE ONLY public.companies ALTER COLUMN id SET DEFAULT nextval('public.companies_id_seq'::regclass);
 ;   ALTER TABLE public.companies ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    248    247    248            Q           2604    180630    countries id    DEFAULT     l   ALTER TABLE ONLY public.countries ALTER COLUMN id SET DEFAULT nextval('public.countries_id_seq'::regclass);
 ;   ALTER TABLE public.countries ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    205    204    205            k           2604    180757    failed_jobs id    DEFAULT     p   ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);
 =   ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    220    219    220            y           2604    180871    interviews id    DEFAULT     n   ALTER TABLE ONLY public.interviews ALTER COLUMN id SET DEFAULT nextval('public.interviews_id_seq'::regclass);
 <   ALTER TABLE public.interviews ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    232    231    232            �           2604    180967    likes id    DEFAULT     d   ALTER TABLE ONLY public.likes ALTER COLUMN id SET DEFAULT nextval('public.likes_id_seq'::regclass);
 7   ALTER TABLE public.likes ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    239    240    240            �           2604    181051    menus id    DEFAULT     d   ALTER TABLE ONLY public.menus ALTER COLUMN id SET DEFAULT nextval('public.menus_id_seq'::regclass);
 7   ALTER TABLE public.menus ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    249    250    250            P           2604    180622    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    203    202    203            �           2604    181014    news id    DEFAULT     b   ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);
 6   ALTER TABLE public.news ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    246    245    246            j           2604    180749     oauth_personal_access_clients id    DEFAULT     �   ALTER TABLE ONLY public.oauth_personal_access_clients ALTER COLUMN id SET DEFAULT nextval('public.oauth_personal_access_clients_id_seq'::regclass);
 O   ALTER TABLE public.oauth_personal_access_clients ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    218    217    218            m           2604    180771    personal_access_tokens id    DEFAULT     �   ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);
 H   ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    222    221    222            ~           2604    180896    podcasts id    DEFAULT     j   ALTER TABLE ONLY public.podcasts ALTER COLUMN id SET DEFAULT nextval('public.podcasts_id_seq'::regclass);
 :   ALTER TABLE public.podcasts ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    233    234    234            s           2604    180825    programs id    DEFAULT     j   ALTER TABLE ONLY public.programs ALTER COLUMN id SET DEFAULT nextval('public.programs_id_seq'::regclass);
 :   ALTER TABLE public.programs ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    227    228    228            �           2604    319935    pub_zones id    DEFAULT     l   ALTER TABLE ONLY public.pub_zones ALTER COLUMN id SET DEFAULT nextval('public.pub_zones_id_seq'::regclass);
 ;   ALTER TABLE public.pub_zones ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    259    260    260            �           2604    180944 
   replays id    DEFAULT     h   ALTER TABLE ONLY public.replays ALTER COLUMN id SET DEFAULT nextval('public.replays_id_seq'::regclass);
 9   ALTER TABLE public.replays ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    237    238    238            �           2604    181090    rule_menus id    DEFAULT     n   ALTER TABLE ONLY public.rule_menus ALTER COLUMN id SET DEFAULT nextval('public.rule_menus_id_seq'::regclass);
 <   ALTER TABLE public.rule_menus ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    254    253    254            �           2604    181117    rule_users id    DEFAULT     n   ALTER TABLE ONLY public.rule_users ALTER COLUMN id SET DEFAULT nextval('public.rule_users_id_seq'::regclass);
 <   ALTER TABLE public.rule_users ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    255    256    256            �           2604    319884 
   seeings id    DEFAULT     h   ALTER TABLE ONLY public.seeings ALTER COLUMN id SET DEFAULT nextval('public.seeings_id_seq'::regclass);
 9   ALTER TABLE public.seeings ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    258    257    258            �           2604    180999 	   shares id    DEFAULT     f   ALTER TABLE ONLY public.shares ALTER COLUMN id SET DEFAULT nextval('public.shares_id_seq'::regclass);
 8   ALTER TABLE public.shares ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    243    244    244            V           2604    180645 	   states id    DEFAULT     f   ALTER TABLE ONLY public.states ALTER COLUMN id SET DEFAULT nextval('public.states_id_seq'::regclass);
 8   ALTER TABLE public.states ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    207    206    207            v           2604    180848 
   streams id    DEFAULT     h   ALTER TABLE ONLY public.streams ALTER COLUMN id SET DEFAULT nextval('public.streams_id_seq'::regclass);
 9   ALTER TABLE public.streams ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    230    229    230            �           2604    181068    sub_menus id    DEFAULT     l   ALTER TABLE ONLY public.sub_menus ALTER COLUMN id SET DEFAULT nextval('public.sub_menus_id_seq'::regclass);
 ;   ALTER TABLE public.sub_menus ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    252    251    252            `           2604    180685    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public          globaltvuser    false    211    210    211            �           2606    319956 0   advertizing_pub_zones advertizing_pub_zones_pkey 
   CONSTRAINT     n   ALTER TABLE ONLY public.advertizing_pub_zones
    ADD CONSTRAINT advertizing_pub_zones_pkey PRIMARY KEY (id);
 Z   ALTER TABLE ONLY public.advertizing_pub_zones DROP CONSTRAINT advertizing_pub_zones_pkey;
       public            globaltvuser    false    262            �           2606    180928    advertizings advertizings_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.advertizings
    ADD CONSTRAINT advertizings_pkey PRIMARY KEY (id);
 H   ALTER TABLE ONLY public.advertizings DROP CONSTRAINT advertizings_pkey;
       public            globaltvuser    false    236            �           2606    180792    banners banners_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.banners
    ADD CONSTRAINT banners_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.banners DROP CONSTRAINT banners_pkey;
       public            globaltvuser    false    224            �           2606    180814    categories categories_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_pkey;
       public            globaltvuser    false    226            �           2606    180674    cities cities_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.cities DROP CONSTRAINT cities_pkey;
       public            globaltvuser    false    209            �           2606    180988    comments comments_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.comments DROP CONSTRAINT comments_pkey;
       public            globaltvuser    false    242            �           2606    181045    companies companies_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.companies
    ADD CONSTRAINT companies_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.companies DROP CONSTRAINT companies_pkey;
       public            globaltvuser    false    248            �           2606    180639    countries countries_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.countries
    ADD CONSTRAINT countries_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.countries DROP CONSTRAINT countries_pkey;
       public            globaltvuser    false    205            �           2606    180763    failed_jobs failed_jobs_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
       public            globaltvuser    false    220            �           2606    180765 #   failed_jobs failed_jobs_uuid_unique 
   CONSTRAINT     ^   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);
 M   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
       public            globaltvuser    false    220            �           2606    180880    interviews interviews_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.interviews
    ADD CONSTRAINT interviews_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.interviews DROP CONSTRAINT interviews_pkey;
       public            globaltvuser    false    232            �           2606    180971    likes likes_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.likes
    ADD CONSTRAINT likes_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.likes DROP CONSTRAINT likes_pkey;
       public            globaltvuser    false    240            �           2606    181057    menus menus_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.menus DROP CONSTRAINT menus_pkey;
       public            globaltvuser    false    250            �           2606    180624    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            globaltvuser    false    203            �           2606    181023    news news_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.news DROP CONSTRAINT news_pkey;
       public            globaltvuser    false    246            �           2606    180727 ,   oauth_access_tokens oauth_access_tokens_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY public.oauth_access_tokens
    ADD CONSTRAINT oauth_access_tokens_pkey PRIMARY KEY (id);
 V   ALTER TABLE ONLY public.oauth_access_tokens DROP CONSTRAINT oauth_access_tokens_pkey;
       public            globaltvuser    false    214            �           2606    180718 &   oauth_auth_codes oauth_auth_codes_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.oauth_auth_codes
    ADD CONSTRAINT oauth_auth_codes_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.oauth_auth_codes DROP CONSTRAINT oauth_auth_codes_pkey;
       public            globaltvuser    false    213            �           2606    180742     oauth_clients oauth_clients_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.oauth_clients
    ADD CONSTRAINT oauth_clients_pkey PRIMARY KEY (id);
 J   ALTER TABLE ONLY public.oauth_clients DROP CONSTRAINT oauth_clients_pkey;
       public            globaltvuser    false    216            �           2606    180751 @   oauth_personal_access_clients oauth_personal_access_clients_pkey 
   CONSTRAINT     ~   ALTER TABLE ONLY public.oauth_personal_access_clients
    ADD CONSTRAINT oauth_personal_access_clients_pkey PRIMARY KEY (id);
 j   ALTER TABLE ONLY public.oauth_personal_access_clients DROP CONSTRAINT oauth_personal_access_clients_pkey;
       public            globaltvuser    false    218            �           2606    180733 .   oauth_refresh_tokens oauth_refresh_tokens_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.oauth_refresh_tokens
    ADD CONSTRAINT oauth_refresh_tokens_pkey PRIMARY KEY (id);
 X   ALTER TABLE ONLY public.oauth_refresh_tokens DROP CONSTRAINT oauth_refresh_tokens_pkey;
       public            globaltvuser    false    215            �           2606    180776 2   personal_access_tokens personal_access_tokens_pkey 
   CONSTRAINT     p   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);
 \   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
       public            globaltvuser    false    222            �           2606    180779 :   personal_access_tokens personal_access_tokens_token_unique 
   CONSTRAINT     v   ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);
 d   ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
       public            globaltvuser    false    222            �           2606    180904    podcasts podcasts_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.podcasts
    ADD CONSTRAINT podcasts_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.podcasts DROP CONSTRAINT podcasts_pkey;
       public            globaltvuser    false    234            �           2606    180832    programs programs_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.programs
    ADD CONSTRAINT programs_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.programs DROP CONSTRAINT programs_pkey;
       public            globaltvuser    false    228            �           2606    319941    pub_zones pub_zones_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.pub_zones
    ADD CONSTRAINT pub_zones_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.pub_zones DROP CONSTRAINT pub_zones_pkey;
       public            globaltvuser    false    260            �           2606    180951    replays replays_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.replays
    ADD CONSTRAINT replays_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.replays DROP CONSTRAINT replays_pkey;
       public            globaltvuser    false    238            �           2606    181096    rule_menus rule_menus_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.rule_menus
    ADD CONSTRAINT rule_menus_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.rule_menus DROP CONSTRAINT rule_menus_pkey;
       public            globaltvuser    false    254            �           2606    181123    rule_users rule_users_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.rule_users
    ADD CONSTRAINT rule_users_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.rule_users DROP CONSTRAINT rule_users_pkey;
       public            globaltvuser    false    256            �           2606    319892    seeings seeings_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.seeings
    ADD CONSTRAINT seeings_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.seeings DROP CONSTRAINT seeings_pkey;
       public            globaltvuser    false    258            �           2606    181003    shares shares_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.shares
    ADD CONSTRAINT shares_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.shares DROP CONSTRAINT shares_pkey;
       public            globaltvuser    false    244            �           2606    180654    states states_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.states
    ADD CONSTRAINT states_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.states DROP CONSTRAINT states_pkey;
       public            globaltvuser    false    207            �           2606    180855    streams streams_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.streams
    ADD CONSTRAINT streams_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.streams DROP CONSTRAINT streams_pkey;
       public            globaltvuser    false    230            �           2606    181074    sub_menus sub_menus_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.sub_menus
    ADD CONSTRAINT sub_menus_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.sub_menus DROP CONSTRAINT sub_menus_pkey;
       public            globaltvuser    false    252            �           2606    180701    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            globaltvuser    false    211            �           2606    180703    users users_phone_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_phone_unique UNIQUE (phone);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_phone_unique;
       public            globaltvuser    false    211            �           2606    180699    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            globaltvuser    false    211            �           1259    180728 !   oauth_access_tokens_user_id_index    INDEX     d   CREATE INDEX oauth_access_tokens_user_id_index ON public.oauth_access_tokens USING btree (user_id);
 5   DROP INDEX public.oauth_access_tokens_user_id_index;
       public            globaltvuser    false    214            �           1259    180719    oauth_auth_codes_user_id_index    INDEX     ^   CREATE INDEX oauth_auth_codes_user_id_index ON public.oauth_auth_codes USING btree (user_id);
 2   DROP INDEX public.oauth_auth_codes_user_id_index;
       public            globaltvuser    false    213            �           1259    180743    oauth_clients_user_id_index    INDEX     X   CREATE INDEX oauth_clients_user_id_index ON public.oauth_clients USING btree (user_id);
 /   DROP INDEX public.oauth_clients_user_id_index;
       public            globaltvuser    false    216            �           1259    180734 *   oauth_refresh_tokens_access_token_id_index    INDEX     v   CREATE INDEX oauth_refresh_tokens_access_token_id_index ON public.oauth_refresh_tokens USING btree (access_token_id);
 >   DROP INDEX public.oauth_refresh_tokens_access_token_id_index;
       public            globaltvuser    false    215            �           1259    180710    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public            globaltvuser    false    212            �           1259    180777 8   personal_access_tokens_tokenable_type_tokenable_id_index    INDEX     �   CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);
 L   DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
       public            globaltvuser    false    222    222                       2606    319962 :   advertizing_pub_zones advertizing_pub_zones_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.advertizing_pub_zones
    ADD CONSTRAINT advertizing_pub_zones_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 d   ALTER TABLE ONLY public.advertizing_pub_zones DROP CONSTRAINT advertizing_pub_zones_author_foreign;
       public          globaltvuser    false    262    211    2999                       2606    319957 <   advertizing_pub_zones advertizing_pub_zones_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.advertizing_pub_zones
    ADD CONSTRAINT advertizing_pub_zones_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 f   ALTER TABLE ONLY public.advertizing_pub_zones DROP CONSTRAINT advertizing_pub_zones_valid_by_foreign;
       public          globaltvuser    false    262    2999    211                       2606    180934 (   advertizings advertizings_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.advertizings
    ADD CONSTRAINT advertizings_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.advertizings DROP CONSTRAINT advertizings_author_foreign;
       public          globaltvuser    false    211    2999    236                       2606    180929 *   advertizings advertizings_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.advertizings
    ADD CONSTRAINT advertizings_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 T   ALTER TABLE ONLY public.advertizings DROP CONSTRAINT advertizings_valid_by_foreign;
       public          globaltvuser    false    211    2999    236            �           2606    180798    banners banners_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.banners
    ADD CONSTRAINT banners_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 H   ALTER TABLE ONLY public.banners DROP CONSTRAINT banners_author_foreign;
       public          globaltvuser    false    2999    211    224            �           2606    180793     banners banners_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.banners
    ADD CONSTRAINT banners_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 J   ALTER TABLE ONLY public.banners DROP CONSTRAINT banners_valid_by_foreign;
       public          globaltvuser    false    224    2999    211            �           2606    180815 $   categories categories_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_author_foreign;
       public          globaltvuser    false    226    2999    211            �           2606    180675    cities cities_state_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.cities
    ADD CONSTRAINT cities_state_id_foreign FOREIGN KEY (state_id) REFERENCES public.states(id) ON UPDATE CASCADE ON DELETE CASCADE;
 H   ALTER TABLE ONLY public.cities DROP CONSTRAINT cities_state_id_foreign;
       public          globaltvuser    false    2991    209    207            
           2606    180989     comments comments_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.comments DROP CONSTRAINT comments_author_foreign;
       public          globaltvuser    false    211    242    2999                       2606    180886 $   interviews interviews_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.interviews
    ADD CONSTRAINT interviews_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 N   ALTER TABLE ONLY public.interviews DROP CONSTRAINT interviews_author_foreign;
       public          globaltvuser    false    232    211    2999                       2606    180881 &   interviews interviews_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.interviews
    ADD CONSTRAINT interviews_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 P   ALTER TABLE ONLY public.interviews DROP CONSTRAINT interviews_valid_by_foreign;
       public          globaltvuser    false    211    2999    232            	           2606    180972    likes likes_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.likes
    ADD CONSTRAINT likes_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.likes DROP CONSTRAINT likes_author_foreign;
       public          globaltvuser    false    240    211    2999                       2606    181058    menus menus_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.menus
    ADD CONSTRAINT menus_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 D   ALTER TABLE ONLY public.menus DROP CONSTRAINT menus_author_foreign;
       public          globaltvuser    false    211    250    2999                       2606    181029    news news_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 B   ALTER TABLE ONLY public.news DROP CONSTRAINT news_author_foreign;
       public          globaltvuser    false    211    246    2999                       2606    181024    news news_valid_by_foreign    FK CONSTRAINT     z   ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 D   ALTER TABLE ONLY public.news DROP CONSTRAINT news_valid_by_foreign;
       public          globaltvuser    false    2999    246    211                       2606    180910     podcasts podcasts_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.podcasts
    ADD CONSTRAINT podcasts_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.podcasts DROP CONSTRAINT podcasts_author_foreign;
       public          globaltvuser    false    2999    234    211                       2606    180905 "   podcasts podcasts_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.podcasts
    ADD CONSTRAINT podcasts_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 L   ALTER TABLE ONLY public.podcasts DROP CONSTRAINT podcasts_valid_by_foreign;
       public          globaltvuser    false    211    234    2999            �           2606    180838     programs programs_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.programs
    ADD CONSTRAINT programs_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.programs DROP CONSTRAINT programs_author_foreign;
       public          globaltvuser    false    228    2999    211            �           2606    180833 "   programs programs_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.programs
    ADD CONSTRAINT programs_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 L   ALTER TABLE ONLY public.programs DROP CONSTRAINT programs_valid_by_foreign;
       public          globaltvuser    false    2999    211    228                       2606    319942 "   pub_zones pub_zones_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.pub_zones
    ADD CONSTRAINT pub_zones_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 L   ALTER TABLE ONLY public.pub_zones DROP CONSTRAINT pub_zones_author_foreign;
       public          globaltvuser    false    2999    260    211                       2606    180957    replays replays_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.replays
    ADD CONSTRAINT replays_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 H   ALTER TABLE ONLY public.replays DROP CONSTRAINT replays_author_foreign;
       public          globaltvuser    false    211    2999    238                       2606    180952     replays replays_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.replays
    ADD CONSTRAINT replays_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 J   ALTER TABLE ONLY public.replays DROP CONSTRAINT replays_valid_by_foreign;
       public          globaltvuser    false    2999    211    238                       2606    181097 $   rule_menus rule_menus_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.rule_menus
    ADD CONSTRAINT rule_menus_author_foreign FOREIGN KEY (author) REFERENCES public.users(id);
 N   ALTER TABLE ONLY public.rule_menus DROP CONSTRAINT rule_menus_author_foreign;
       public          globaltvuser    false    254    2999    211                       2606    181102 "   rule_menus rule_menus_menu_foreign    FK CONSTRAINT     ~   ALTER TABLE ONLY public.rule_menus
    ADD CONSTRAINT rule_menus_menu_foreign FOREIGN KEY (menu) REFERENCES public.menus(id);
 L   ALTER TABLE ONLY public.rule_menus DROP CONSTRAINT rule_menus_menu_foreign;
       public          globaltvuser    false    250    254    3051                       2606    181107 %   rule_menus rule_menus_submenu_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.rule_menus
    ADD CONSTRAINT rule_menus_submenu_foreign FOREIGN KEY (submenu) REFERENCES public.sub_menus(id);
 O   ALTER TABLE ONLY public.rule_menus DROP CONSTRAINT rule_menus_submenu_foreign;
       public          globaltvuser    false    3053    254    252                       2606    181124 $   rule_users rule_users_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.rule_users
    ADD CONSTRAINT rule_users_author_foreign FOREIGN KEY (author) REFERENCES public.users(id);
 N   ALTER TABLE ONLY public.rule_users DROP CONSTRAINT rule_users_author_foreign;
       public          globaltvuser    false    256    211    2999                       2606    181134 "   rule_users rule_users_rule_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.rule_users
    ADD CONSTRAINT rule_users_rule_foreign FOREIGN KEY (rule) REFERENCES public.rule_menus(id);
 L   ALTER TABLE ONLY public.rule_users DROP CONSTRAINT rule_users_rule_foreign;
       public          globaltvuser    false    254    256    3055                       2606    181129 "   rule_users rule_users_user_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.rule_users
    ADD CONSTRAINT rule_users_user_foreign FOREIGN KEY ("user") REFERENCES public.users(id);
 L   ALTER TABLE ONLY public.rule_users DROP CONSTRAINT rule_users_user_foreign;
       public          globaltvuser    false    256    2999    211                       2606    181004    shares shares_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.shares
    ADD CONSTRAINT shares_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 F   ALTER TABLE ONLY public.shares DROP CONSTRAINT shares_author_foreign;
       public          globaltvuser    false    2999    244    211            �           2606    180655     states states_country_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.states
    ADD CONSTRAINT states_country_id_foreign FOREIGN KEY (country_id) REFERENCES public.countries(id) ON UPDATE CASCADE ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.states DROP CONSTRAINT states_country_id_foreign;
       public          globaltvuser    false    205    2989    207                        2606    180861    streams streams_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.streams
    ADD CONSTRAINT streams_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 H   ALTER TABLE ONLY public.streams DROP CONSTRAINT streams_author_foreign;
       public          globaltvuser    false    2999    211    230            �           2606    180856     streams streams_valid_by_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.streams
    ADD CONSTRAINT streams_valid_by_foreign FOREIGN KEY (valid_by) REFERENCES public.users(id);
 J   ALTER TABLE ONLY public.streams DROP CONSTRAINT streams_valid_by_foreign;
       public          globaltvuser    false    230    2999    211                       2606    181075 "   sub_menus sub_menus_author_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.sub_menus
    ADD CONSTRAINT sub_menus_author_foreign FOREIGN KEY (author) REFERENCES public.users(id) ON DELETE CASCADE;
 L   ALTER TABLE ONLY public.sub_menus DROP CONSTRAINT sub_menus_author_foreign;
       public          globaltvuser    false    2999    211    252                       2606    181080     sub_menus sub_menus_menu_foreign    FK CONSTRAINT     |   ALTER TABLE ONLY public.sub_menus
    ADD CONSTRAINT sub_menus_menu_foreign FOREIGN KEY (menu) REFERENCES public.menus(id);
 J   ALTER TABLE ONLY public.sub_menus DROP CONSTRAINT sub_menus_menu_foreign;
       public          globaltvuser    false    252    3051    250           