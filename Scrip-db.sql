PGDMP                       }         	   Traductor    17.4    17.4 5    a           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                           false            b           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                           false            c           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                           false            d           1262    16468 	   Traductor    DATABASE     q   CREATE DATABASE "Traductor" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'es-ES';
    DROP DATABASE "Traductor";
                     postgres    false                        2615    16509 
   translator    SCHEMA        CREATE SCHEMA translator;
    DROP SCHEMA translator;
                     postgres    false            �            1259    16613 
   usr_id_seq    SEQUENCE     s   CREATE SEQUENCE public.usr_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 !   DROP SEQUENCE public.usr_id_seq;
       public               postgres    false            �            1259    16614    usr_id_usr_seq    SEQUENCE     w   CREATE SEQUENCE public.usr_id_usr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.usr_id_usr_seq;
       public               postgres    false            �            1259    16528    Original_Texts    TABLE     �   CREATE TABLE translator."Original_Texts" (
    id_orig_t integer NOT NULL,
    source_content character varying,
    cod_trad_resq integer,
    cod_typ_writing integer
);
 (   DROP TABLE translator."Original_Texts";
    
   translator         heap r       postgres    false    6            �            1259    16619    Original_Texts_id_seq    SEQUENCE     �   ALTER TABLE translator."Original_Texts" ALTER COLUMN id_orig_t ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Original_Texts_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    223    6            �            1259    16516    Shipping_History    TABLE     �   CREATE TABLE translator."Shipping_History" (
    "id_shipp_H" integer NOT NULL,
    "date_Subm" timestamp with time zone,
    envoy boolean,
    cod_translation integer
);
 *   DROP TABLE translator."Shipping_History";
    
   translator         heap r       postgres    false    6            �            1259    16620    Shipping_History_id_seq    SEQUENCE     �   ALTER TABLE translator."Shipping_History" ALTER COLUMN "id_shipp_H" ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Shipping_History_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    219    6            �            1259    16519    Translation_Requests    TABLE     �   CREATE TABLE translator."Translation_Requests" (
    id_t_reque integer NOT NULL,
    date_request timestamp with time zone,
    state character varying,
    shipping_edium character varying,
    cod_usr bigint
);
 .   DROP TABLE translator."Translation_Requests";
    
   translator         heap r       postgres    false    6            �            1259    16622    Translation_Requests_id_seq    SEQUENCE     �   ALTER TABLE translator."Translation_Requests" ALTER COLUMN id_t_reque ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Translation_Requests_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    220    6            �            1259    16522    Translations    TABLE     �   CREATE TABLE translator."Translations" (
    id_trans integer NOT NULL,
    transld_contn character varying,
    translation_date timestamp with time zone,
    cod_text_oring integer
);
 &   DROP TABLE translator."Translations";
    
   translator         heap r       postgres    false    6            �            1259    16647    Translations_id_trans_seq    SEQUENCE     �   ALTER TABLE translator."Translations" ALTER COLUMN id_trans ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Translations_id_trans_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    221    6            �            1259    16525    Types_Writing    TABLE     �   CREATE TABLE translator."Types_Writing" (
    id_typ_w integer NOT NULL,
    nombre character varying,
    description character varying
);
 '   DROP TABLE translator."Types_Writing";
    
   translator         heap r       postgres    false    6            �            1259    16623    Types_Writing_id_seq    SEQUENCE     �   ALTER TABLE translator."Types_Writing" ALTER COLUMN id_typ_w ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Types_Writing_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    222    6            �            1259    16510    usr    TABLE     �   CREATE TABLE translator.usr (
    id_usr integer NOT NULL,
    name character varying,
    email character varying,
    registration_date timestamp with time zone,
    password character varying
);
    DROP TABLE translator.usr;
    
   translator         heap r       postgres    false    6            �            1259    16617 
   Usr_id_seq    SEQUENCE     �   ALTER TABLE translator.usr ALTER COLUMN id_usr ADD GENERATED BY DEFAULT AS IDENTITY (
    SEQUENCE NAME translator."Usr_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
         
   translator               postgres    false    6    218            �            1259    16624 	   usr_admin    TABLE     �   CREATE TABLE translator.usr_admin (
    id_usr character varying NOT NULL,
    name character varying,
    email character varying,
    password character varying,
    cod_usr integer,
    cod_transl integer,
    "cod_transl_H" integer
);
 !   DROP TABLE translator.usr_admin;
    
   translator         heap r       postgres    false    6            �            1259    16616 
   usr_id_seq    SEQUENCE     w   CREATE SEQUENCE translator.usr_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE translator.usr_id_seq;
    
   translator               postgres    false    6            �            1259    16615    usr_id_usr_seq    SEQUENCE     {   CREATE SEQUENCE translator.usr_id_usr_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE translator.usr_id_usr_seq;
    
   translator               postgres    false    6            S          0    16528    Original_Texts 
   TABLE DATA           i   COPY translator."Original_Texts" (id_orig_t, source_content, cod_trad_resq, cod_typ_writing) FROM stdin;
 
   translator               postgres    false    223   aC       O          0    16516    Shipping_History 
   TABLE DATA           c   COPY translator."Shipping_History" ("id_shipp_H", "date_Subm", envoy, cod_translation) FROM stdin;
 
   translator               postgres    false    219   �G       P          0    16519    Translation_Requests 
   TABLE DATA           n   COPY translator."Translation_Requests" (id_t_reque, date_request, state, shipping_edium, cod_usr) FROM stdin;
 
   translator               postgres    false    220   �G       Q          0    16522    Translations 
   TABLE DATA           g   COPY translator."Translations" (id_trans, transld_contn, translation_date, cod_text_oring) FROM stdin;
 
   translator               postgres    false    221   L       R          0    16525    Types_Writing 
   TABLE DATA           L   COPY translator."Types_Writing" (id_typ_w, nombre, description) FROM stdin;
 
   translator               postgres    false    222   �N       N          0    16510    usr 
   TABLE DATA           S   COPY translator.usr (id_usr, name, email, registration_date, password) FROM stdin;
 
   translator               postgres    false    218   �O       ]          0    16624 	   usr_admin 
   TABLE DATA           k   COPY translator.usr_admin (id_usr, name, email, password, cod_usr, cod_transl, "cod_transl_H") FROM stdin;
 
   translator               postgres    false    233   KR       e           0    0 
   usr_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.usr_id_seq', 1, false);
          public               postgres    false    224            f           0    0    usr_id_usr_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.usr_id_usr_seq', 1, false);
          public               postgres    false    225            g           0    0    Original_Texts_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('translator."Original_Texts_id_seq"', 89, true);
       
   translator               postgres    false    229            h           0    0    Shipping_History_id_seq    SEQUENCE SET     L   SELECT pg_catalog.setval('translator."Shipping_History_id_seq"', 10, true);
       
   translator               postgres    false    230            i           0    0    Translation_Requests_id_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('translator."Translation_Requests_id_seq"', 96, true);
       
   translator               postgres    false    231            j           0    0    Translations_id_trans_seq    SEQUENCE SET     N   SELECT pg_catalog.setval('translator."Translations_id_trans_seq"', 27, true);
       
   translator               postgres    false    234            k           0    0    Types_Writing_id_seq    SEQUENCE SET     H   SELECT pg_catalog.setval('translator."Types_Writing_id_seq"', 2, true);
       
   translator               postgres    false    232            l           0    0 
   Usr_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('translator."Usr_id_seq"', 20, true);
       
   translator               postgres    false    228            m           0    0 
   usr_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('translator.usr_id_seq', 1, false);
       
   translator               postgres    false    227            n           0    0    usr_id_usr_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('translator.usr_id_usr_seq', 1, false);
       
   translator               postgres    false    226            �           2606    16564 "   Original_Texts Original_Texts_pkey 
   CONSTRAINT     o   ALTER TABLE ONLY translator."Original_Texts"
    ADD CONSTRAINT "Original_Texts_pkey" PRIMARY KEY (id_orig_t);
 T   ALTER TABLE ONLY translator."Original_Texts" DROP CONSTRAINT "Original_Texts_pkey";
    
   translator                 postgres    false    223            �           2606    16542 &   Shipping_History Shipping_History_pkey 
   CONSTRAINT     v   ALTER TABLE ONLY translator."Shipping_History"
    ADD CONSTRAINT "Shipping_History_pkey" PRIMARY KEY ("id_shipp_H");
 X   ALTER TABLE ONLY translator."Shipping_History" DROP CONSTRAINT "Shipping_History_pkey";
    
   translator                 postgres    false    219            �           2606    16551 .   Translation_Requests Translation_Requests_pkey 
   CONSTRAINT     |   ALTER TABLE ONLY translator."Translation_Requests"
    ADD CONSTRAINT "Translation_Requests_pkey" PRIMARY KEY (id_t_reque);
 `   ALTER TABLE ONLY translator."Translation_Requests" DROP CONSTRAINT "Translation_Requests_pkey";
    
   translator                 postgres    false    220            �           2606    16560    Translations Translations_pkey 
   CONSTRAINT     j   ALTER TABLE ONLY translator."Translations"
    ADD CONSTRAINT "Translations_pkey" PRIMARY KEY (id_trans);
 P   ALTER TABLE ONLY translator."Translations" DROP CONSTRAINT "Translations_pkey";
    
   translator                 postgres    false    221            �           2606    16568     Types_Writing Types_Writing_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY translator."Types_Writing"
    ADD CONSTRAINT "Types_Writing_pkey" PRIMARY KEY (id_typ_w);
 R   ALTER TABLE ONLY translator."Types_Writing" DROP CONSTRAINT "Types_Writing_pkey";
    
   translator                 postgres    false    222            �           2606    16630    usr_admin Usr_Admin_pkey 
   CONSTRAINT     `   ALTER TABLE ONLY translator.usr_admin
    ADD CONSTRAINT "Usr_Admin_pkey" PRIMARY KEY (id_usr);
 H   ALTER TABLE ONLY translator.usr_admin DROP CONSTRAINT "Usr_Admin_pkey";
    
   translator                 postgres    false    233            �           2606    16660    usr Usr_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY translator.usr
    ADD CONSTRAINT "Usr_pkey" PRIMARY KEY (id_usr);
 <   ALTER TABLE ONLY translator.usr DROP CONSTRAINT "Usr_pkey";
    
   translator                 postgres    false    218            �           2606    16579 0   Original_Texts Original_Texts_cod_trad_resq_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator."Original_Texts"
    ADD CONSTRAINT "Original_Texts_cod_trad_resq_fkey" FOREIGN KEY (cod_trad_resq) REFERENCES translator."Translation_Requests"(id_t_reque) NOT VALID;
 b   ALTER TABLE ONLY translator."Original_Texts" DROP CONSTRAINT "Original_Texts_cod_trad_resq_fkey";
    
   translator               postgres    false    220    223    4781            �           2606    16584 2   Original_Texts Original_Texts_cod_typ_writing_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator."Original_Texts"
    ADD CONSTRAINT "Original_Texts_cod_typ_writing_fkey" FOREIGN KEY (cod_typ_writing) REFERENCES translator."Types_Writing"(id_typ_w) NOT VALID;
 d   ALTER TABLE ONLY translator."Original_Texts" DROP CONSTRAINT "Original_Texts_cod_typ_writing_fkey";
    
   translator               postgres    false    4785    222    223            �           2606    16653 6   Shipping_History Shipping_History_cod_translation_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator."Shipping_History"
    ADD CONSTRAINT "Shipping_History_cod_translation_fkey" FOREIGN KEY (cod_translation) REFERENCES translator."Translations"(id_trans) NOT VALID;
 h   ALTER TABLE ONLY translator."Shipping_History" DROP CONSTRAINT "Shipping_History_cod_translation_fkey";
    
   translator               postgres    false    4783    219    221            �           2606    16661 6   Translation_Requests Translation_Requests_cod_usr_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator."Translation_Requests"
    ADD CONSTRAINT "Translation_Requests_cod_usr_fkey" FOREIGN KEY (cod_usr) REFERENCES translator.usr(id_usr) NOT VALID;
 h   ALTER TABLE ONLY translator."Translation_Requests" DROP CONSTRAINT "Translation_Requests_cod_usr_fkey";
    
   translator               postgres    false    218    220    4777            �           2606    16569 -   Translations Translations_cod_text_oring_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator."Translations"
    ADD CONSTRAINT "Translations_cod_text_oring_fkey" FOREIGN KEY (cod_text_oring) REFERENCES translator."Original_Texts"(id_orig_t) NOT VALID;
 _   ALTER TABLE ONLY translator."Translations" DROP CONSTRAINT "Translations_cod_text_oring_fkey";
    
   translator               postgres    false    4787    223    221            �           2606    16637 #   usr_admin Usr_Admin_cod_transl_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator.usr_admin
    ADD CONSTRAINT "Usr_Admin_cod_transl_fkey" FOREIGN KEY (cod_transl) REFERENCES translator."Translations"(id_trans) NOT VALID;
 S   ALTER TABLE ONLY translator.usr_admin DROP CONSTRAINT "Usr_Admin_cod_transl_fkey";
    
   translator               postgres    false    221    233    4783            �           2606    16666     usr_admin Usr_Admin_cod_usr_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY translator.usr_admin
    ADD CONSTRAINT "Usr_Admin_cod_usr_fkey" FOREIGN KEY (cod_usr) REFERENCES translator.usr(id_usr) NOT VALID;
 P   ALTER TABLE ONLY translator.usr_admin DROP CONSTRAINT "Usr_Admin_cod_usr_fkey";
    
   translator               postgres    false    233    218    4777            S      x��Z�n�0={���V����TqA\��ś�`����T�k���?���h���T��&�������]�|0����q:|������f�&Ӻ�w�;��+��ͭ���
Vl{mF>o{��Qg�݇@&F����x��.pC0��S �hx�6�����s�e���1�|���zg�d����{�An��;�B�O�^\|�t����y$��*���b�>�q������h�L�,o��y]�#�4��Z,������J���B$�ϳ�>������@�e�$L��1K¬���]�Z�/�`�`����C��3�����l|Gp3���t��h����(VTѤ�PLl��I140��50DZ�2)�� F�� F�C C�Ő��i1J`������V�:iu.�s�V�:iu.�s�V�:iu.�s�V�:iu.�s�V�:iu.�s�V�:�iu.�s�V�:�iu.�s�V�%t.�꼄�eZ���9�����$���rI !I����F7��NVBD�r��Y����~F@�v�B����Y���}�ފ�Z{KGh
�7��yvt#���l�J0��u�=���i�:X�wd���]B�����c	�9Fj@����r���NG����&��η�4�/W����jY�����6|o���d{��Q�ߎ�z�]���H����
$2��>�M������?p{�gt.}��	�t�{�{�r���r$��rCa���g�b���{�\���8�{V�&V2w�)lPWe�a,���H���*���_�\�jcUg�>jb�d�>j����}CUd�>��ʶSU��*�NU��l;U�*��l�_^\�l�G�U�V]������UW5g�L0�§�mY@���6b�, ��s��G���\a�F���C�Zc�@�5�/R����X '�N��d���58Y��<��HY�!eR�璒5`b����X�ab&�k�؀���_�4��K5{iJr�<���<�S�����r3����M��-�i�=�ʯ��ۗ���f�Y�+t      O   *   x�34�4202�50�5�P0��20�20r9c�8�b���� zQ      P   ;  x�u�Mn%7���S�"�_T�%��b�d�E�\?�7@f����$��"i����c_8o���~���_�}��C.���'z��B#�=e���?�~~�������?�����[�6⢲�������M>8�}�@@�f3�T[`� bG)�fJ!�_)�t[�Pq* x�A����'�T	���2e���J�M6�d7ļX
a|3	RꈼX�������iAXC�v5뉟��/D7���%�JLd�`��C��Ix�i���"+�^�#�=�
�$����B��[���t�\���'�V R �[����Z	ߗ�̺aX%b'	�3w��J�ի�ĻdQ%�<r24�w��~?ܸ-Y Y�l #���*�;��\���R!�v��Q��9l�W���M"��C��#�eK;"/�B �9qFu��'E���DT�nO��l�@U|b� ��ެ�J�wFt9�* �O!G���8Tl���DU���I����*�=g({�bAT�anÄr�jXU�^��R:Q�y�>��'�����b�=�8�]0�*f_N�O�0+0��ۂ�I�痵�je��g8b;�0��A�+��dI���&9�0�ݞȢ��@h!�[O���{�[%�<8�k�b@�i�+mO��F���3�I�,A�Y��Ye Mg��m��fo���LW�������G&I��
~���P�R�.:�@��>B������5V	{M�v���]r�m ep�'��U�=`V w򩇰� �sw����b=	�,O���
���29z_�\���0+4�CS����,�w���{殍CӜV	��k9�p��@�Ȩy��3*1wGK�~}1+�{'0g���f%0�c�Z9�m�z�;�ٖH*&+"���Hn�$S��8R*!�:�dk� ����]O)ɽ�Y5��z�d��Y5����C�g�\�eV*��� �����y6���c�5��fOT�޳�y�ׂ�XUs�=�,Gb�q�w��i�9`>�ՒB�DKS�C.}j���O����N�IЕW{'�֛�{���d�k��4�(��1�CEڗ�~�u���L�      Q   �  x���K��0���8��g���B\�\��,Ye��+��3qV�7HU)N;��d���Ar�X��H7�n�$��]����8�i<�w��㱴����R.s��P�Y.���9���"�z�-�'�m��r�gY/�\�rʲ�M���L�\�$���.��Oy*s���ӓKnu�P�V�vϬ0���y�RC�&�U��J'�Osi�՛�gY�?V��>�-Oy��E�Ӝ�,vˮ>i�.���z���x��k^[��Z���n��e)�������Yr�|nPo�XeiedS�޲�k�o%G,�25NŉO�;��OSag�)s�#�|z��&��ʃq�E�����XW#us�SZ8M=!�ȏ�p�1~��61��B���N(°��}=l��wxH�y-u��"�稣�d��½����dA�6�ot {��(G�]ϣG���_.H�э �+=(���F��~tL6(�����I �G7+��[Az'��I�r786�����v��#h�� `�VE��V�x]�G��*��"�����-p�^���*`�����Ő֑���;�{5hL:&�9�u_0�
ܫAc^�F�ۨ��@�j�N7���J�R��؎^)g��i�����~�Xx.���x������x��(�>��?�������l�~�͋��z���������<V�՛R_����      R   �   x�uO;��@�����"AIGAGU�a�D~;��"��8{D��u��=�E���BW9��h�>�o��("����%f9�<e��'ή��#O6�ZX6[־�i������G�ڿ�m�+�,��<�3g����E�>���>^�N;�W��(χzI�2�y���|&���"1f���?�����X9qۆ�!��Fm      N   ~  x�u�I��@��p
�MQU��(����-�)�(-D���X�N�=�b��a���`ӂ�ZH>����Y.`��oP����U�@ M�!j���_|�I��W8
W�W��yDSm><���`�r��U ��uG����:� 	�b��,[&��1�47-C�] �_l$���[w�~�ڡ{|�įV�a��'���mAOe���A��9(�n%"UxK/))ZNR΄���ķ�B��Վ�]��ly[�6h��d��R72�>f�4�1��g���.Ol�ϑ՗�=�4��1�(/Y�ZiLx��~�(��m�+�@m�M�
�ښ��0�]�MM������$����t���D���I����=4
t�Lh�P!�_A�Q�����t���>���,������hQ<��i��W���B�
�	Y>�����	OYˢ�%��D�;Z��Xyҹ����7�|p�O�:ެ(�/\���%���������x>�_]��"2���D��O��-ܸnwdh�l�iߥ��Ь�& 5`����7N�2U��n����Sn
9���e�*�nf�61�q�65�]���f]�ۚ� �t��n/c_�����N���Ca>X�v��@h*��f6�[�"�?�(����"a      ]   �   x�e���0 ���)��L�&?BL��q�R, U	��QGs�o�o8�%��5{��>�5�کk��_��T�,J/~��"������BV(̢ $��b��P�R�@�������t���k�([V\(�ɒݕ���?�����]'�~��1��?���yt�s��µ�E`$�9�;Sϻo��c*Z���_�A��L�D     