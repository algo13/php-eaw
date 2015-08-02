<?php
/**
 * mb_east_asian_width.inc.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
// array mb_east_asian_width_names(string $string, string $encoding = mb_internal_encoding())
function mb_east_asian_width_names($string, $encoding = null)
{
    static $eaw_table;
    static $eaw_names = array('N', 'A', 'H', 'W', 'F', 'Na');
    if ($eaw_table === null) {
        $assoc_keys = '4h,4k,4p,4q,4r,4s,4v,51,57,5i,5s,6e,6f,6j,6o,6p,6z,70,71,72,75,7l,7m,7n,7v,8b,8o,8z,90,98,99,a3,cu,cv,cw,cx,cy,cz,d0,d1,d2,d3,d4,d5,d6,d7,d8,gh,gx,jo,jr,js,jw,jx,k0,kc,kd,ke,kf,p8,qq,sh,uo,up,1ni,1wy,1xz,20s,21d,21q,24w,261,2ak,2c0,2c7,2ji,2mv,2pp,2q2,2qe,2v8,2ve,2vh,2w5,2w7,2x2,3bb,3bh,3mg,3pc,4zk,66x,66z,671,6c0,6c7,6cj,6cw,6cx,6d0,6d1,6d7,6da,6es,6f3,6f4,6g9,6gc,6ir,6is,6it,6ix,6j7,6ja,6jq,6jv,6lb,6mh,6oi,6oj,6ok,6p3,6ps,6pt,6q3,6q7,6q8,6q9,6qd,6qi,6qr,6qs,6qt,6qu,6r1,6r2,6rs,6rw,6s2,6tx,6u1,6ud,6v3,6xe,7ai,7fm,7gr,7hr,7ih,7j0,7j1,7j2,7k0,7k1,7k2,7ky,7l2,7l7,7la,7lb,7ny,7oi,7oj,7r1,7rr,8x3,8x9,9hc,9j3,xgf,1dmm,1edb,1ekd,1ew0,1fn3,1g5k,1g70,1ge7,1i88,1ids,1idz,1ji7,2kki,2kl7,2kp2,2plw,2plz,2pmh,2pmj,2pmq,2pmv,2pmx,2pmz,2pn8,2pnb,2pnd,2pnf,2pnh,2pnj,2pno,2poe,2q7i,2rwg,jny9';
        $assoc_values = '110105500111001001011101111010111010101010101011111001101010010100000000000000000000000000000010010011111021101111110110111011011110100111111111001111011010000100111004000010000000000000000000000000000000';
        $range = array(
            '0,w,3j,4i,4l,4n,4t,4w,52,58,5c,5j,5t,5z,61,66,6a,6g,6k,6m,6q,6s,6v,73,76,7o,7w,86,88,8c,8h,8k,8p,8v,91,94,9a,9e,9g,9y,a0,a4,d9,gi,gy,jp,jt,jy,k1,k8,kg,lc,og,oq,p0,pa,pd,pv,q2,q9,qr,qy,si,sw,uq,10x,121,129,13d,13h,13l,15c,168,16o,17i,1e7,1fx,1j4,1kw,1m8,1mo,1pc,1r7,1vp,1vz,1w3,1wq,1x2,1x8,1xj,1xn,1y4,1y7,1ye,1z5,1z9,1zj,1zn,20a,20i,20l,20o,20u,213,217,21l,21y,22p,22t,233,237,23u,242,245,24c,24n,24r,25c,25i,269,26d,26n,26r,27e,27m,27p,27w,287,28b,28m,28s,28v,292,29u,29x,2a6,2aa,2ah,2am,2ar,2aw,2b2,2bi,2bq,2bu,2cm,2dc,2dh,2dq,2du,2ei,2f1,2fa,2fe,2fp,2fs,2g0,2g6,2go,2gx,2h1,2ha,2he,2i2,2id,2ik,2iu,2iy,2j9,2jk,2jq,2k1,2kh,2kl,2ku,2ky,2m5,2me,2mi,2n3,2na,2nt,2o2,2o5,2oq,2pf,2ps,2q7,2qg,2qu,2r6,2rl,2tb,2v5,2vb,2vo,2vt,2w1,2wa,2wd,2wr,2ww,2x4,2xc,2xo,2yo,30p,31t,32x,33y,34e,35s,3bk,3cw,3fk,3m2,3m8,3mi,3mo,3nu,3o0,3oy,3p4,3pe,3pk,3q0,3rm,3rs,3tp,3uo,3vk,3y0,3y8,4gw,4jk,4jy,4kg,4lc,4m8,4mm,4mq,4n4,4ps,4q8,4qo,4r4,4rk,4u8,4vk,4xs,4yo,4z4,4zo,50w,51c,52o,53k,53y,55q,57k,58f,58w,59c,59s,5c0,5e8,5fk,5j0,5kr,5l9,5og,5ow,5q0,5q8,5x8,654,65c,66g,66o,673,680,69i,69y,6ae,6al,6b6,6ba,6bk,6c1,6c3,6c8,6ca,6cc,6ce,6cg,6ck,6co,6cy,6d2,6d8,6db,6ee,6et,6f5,6f9,6fk,6g0,6ga,6gd,6hc,6io,6iu,6iy,6j8,6jb,6jl,6jn,6jr,6jw,6kz,6l1,6l7,6lc,6lo,6ls,6m2,6mi,6mo,6my,6ns,6nu,6ol,6p4,6pu,6pw,6pz,6q1,6q4,6qa,6qe,6qj,6ql,6qp,6qv,6r3,6r8,6rc,6rg,6ri,6rt,6rx,6s3,6sg,6si,6sk,6so,6sq,6ss,6su,6sw,6te,6tg,6ti,6tk,6ty,6u2,6ue,6v4,6xf,6y1,6y3,740,75s,76o,7aj,7d8,7dc,7ec,7eo,7f4,7f6,7fa,7fk,7fn,7fu,7g2,7g4,7g6,7g8,7gc,7ge,7gg,7gi,7gm,7gp,7gs,7gu,7gy,7he,7hi,7hs,7id,7if,7ii,7im,7io,7is,7iu,7j3,7k3,7kw,7kz,7l3,7l8,7lc,7mm,7mo,7ni,7nk,7no,7nz,7ok,7oo,7pc,7r2,7rs,7sm,7sw,7vq,7vy,879,87b,8k5,8ka,8l2,8m0,8n1,8ne,8oc,8ow,8q8,8rk,8vt,8xc,8z3,8zj,90g,90o,90w,914,91c,91k,91s,920,928,96o,97f,9a8,9gw,9hd,9j5,9ll,9ol,9pt,9sg,9ts,9v4,9wg,9xk,9xs,a2o,fcw,feo,wi8,wk0,wu8,wzk,x4g,x6f,x80,x8g,xa8,xce,xcw,xds,xgg,xhc,xjj,xjy,xkw,xmo,xn4,xng,xqz,xs1,xs9,xsh,xsw,xt4,xtc,xv4,xyo,xz4,16ls,16mj,16o0,188w,1d6o,1dkw,1dlf,1dlp,1dmg,1dmo,1dmr,1dmu,1dqr,1e1c,1e36,1e5s,1e68,1e6o,1e74,1e7k,1e8k,1e94,1e9c,1e9i,1edd,1eg1,1eiq,1eiy,1ej6,1eje,1ejk,1ejs,1ek9,1ekg,1ekt,1elk,1em4,1em7,1emo,1eo0,1erk,1err,1et3,1evk,1exc,1f28,1f34,1f4w,1f5s,1f74,1f80,1f9c,1fa7,1fbc,1fcw,1fhc,1fk0,1flc,1fr4,1g00,1g0w,1g5c,1g5m,1g6v,1g73,1g7r,1g9z,1gbk,1gc4,1gcb,1gdb,1gg0,1gho,1gia,1gjp,1gjw,1gk5,1gk9,1gl4,1glb,1gls,1gm8,1gow,1gq3,1gqo,1gs9,1gt4,1gu0,1gux,1gvd,1gxs,1h1c,1h34,1h4q,1heo,1hq8,1hsi,1htr,1hw0,1hww,1hxc,1hyu,1hzk,1i0w,1i34,1i3l,1i4g,1i4z,1i80,1i8a,1i8f,1i8v,1i9c,1ib4,1ibk,1ibp,1ibz,1ic3,1icq,1icy,1id1,1id8,1idj,1idn,1ie5,1iee,1ieo,1im8,1iog,1itc,1iuw,1iww,1iz4,1j0g,1j28,1j40,1j4t,1j5c,1jfk,1juo,1kw0,1log,1lrk,1ls0,1o1s,1s00,1z40,1zk0,1zkw,1zla,1zo0,1zow,1zpc,1zrk,1zrv,1zs3,1zst,20hs,20k0,20lr,2dc0,2fpc,2fsg,2fsw,2ftc,2fto,2jnk,2juo,2jvt,2k1s,2k8w,2kbk,2kg0,2kie,2kke,2kkl,2kkp,2kku,2kl9,2klh,2knb,2knh,2knq,2kny,2kor,2kow,2kp6,2kpe,2kyw,2l72,2lqz,2lr5,2oe8,2ojr,2pkw,2pl1,2plt,2pm1,2pmc,2pn1,2pn5,2pnl,2pnr,2pnw,2po4,2po9,2pog,2por,2ppd,2pph,2ppn,2prk,2pz4,2q0g,2q3k,2q41,2q4h,2q4x,2q68,2q6j,2q6o,2q7k,2q96,2q9c,2qcm,2qdc,2qds,2qf4,2qfk,2qkg,2r23,2r39,2rc0,2rcg,2rcw,2rgg,2rk0,2rkg,2rm8,2rmo,2ro0,2rrk,2ruo,2t4w,47pc,jnz4,jo5c,l2io,mh34',
            'v,3i,4g,4j,4m,4o,4u,50,56,5b,5h,5r,5y,60,65,69,6d,6i,6l,6n,6r,6u,6y,74,7k,7u,85,87,8a,8g,8j,8n,8u,8y,93,97,9d,9f,9x,9z,a2,ct,gg,gw,jn,jq,jv,jz,k7,kb,lb,of,on,ov,p6,pc,pt,q1,q8,qp,qx,sg,sv,un,10v,11y,127,13b,13e,13j,153,162,16c,17g,1e5,1fu,1ip,1kq,1m5,1mm,1nf,1pw,1vn,1vw,1w0,1wo,1ww,1x5,1xg,1xk,1xq,1y5,1yb,1yz,1z7,1ze,1zk,208,20g,20j,20m,20p,20y,214,219,21o,22d,22r,231,235,23s,240,243,249,24l,24p,24t,25f,25t,26b,26k,26o,27c,27k,27n,27t,284,288,28d,28n,28t,28z,29j,29v,2a2,2a8,2ad,2ai,2an,2as,2ay,2bd,2bm,2bs,2bx,2d6,2df,2do,2ds,2eg,2ex,2f8,2fc,2fh,2fq,2fu,2g3,2gf,2gv,2gz,2h8,2hc,2i0,2ib,2ih,2is,2iw,2j1,2ja,2jn,2jz,2k2,2kj,2ks,2kw,2m2,2mc,2mg,2mm,2n7,2np,2nz,2o3,2om,2pd,2pn,2py,2qc,2qn,2r3,2r8,2t6,2u3,2v6,2vc,2vr,2vz,2w3,2wb,2wp,2wt,2x0,2x9,2xl,2xr,30n,31o,32v,33w,34c,34q,3b9,3cv,3fj,3m0,3m5,3me,3ml,3ns,3nx,3ow,3p1,3pa,3ph,3py,3rk,3rp,3tm,3uk,3vd,3xx,3y5,4gs,4jc,4jw,4k4,4l2,4lv,4mk,4mo,4mr,4pp,4q1,4qh,4r2,4rd,4tz,4ve,4xh,4ym,4yz,4zf,50t,510,52j,53d,53u,55n,57i,58c,58p,595,59p,5a6,5e3,5fg,5ir,5kn,5l5,5mn,5on,5py,5q1,5x1,651,659,66d,66l,66v,67x,69g,69w,6ab,6aj,6b3,6b8,6bi,6bz,6c2,6c6,6c9,6cb,6cd,6cf,6ci,6cn,6cv,6cz,6d6,6d9,6ec,6ep,6f2,6f8,6fi,6fw,6g8,6gb,6gu,6i8,6iq,6iw,6j6,6j9,6jk,6jm,6jp,6ju,6ky,6l0,6l6,6la,6ln,6lr,6m1,6mg,6mj,6mx,6nr,6nt,6oh,6p2,6pr,6pv,6py,6q0,6q2,6q6,6qc,6qh,6qk,6qo,6qq,6r0,6r7,6rb,6rf,6rh,6rr,6rv,6s1,6sf,6sh,6sj,6sn,6sp,6sr,6st,6sv,6td,6tf,6th,6tj,6tw,6u0,6uc,6v2,6xd,6y0,6y2,73u,752,762,7ah,7d7,7db,7eb,7en,7f3,7f5,7f9,7fj,7fl,7ft,7g1,7g3,7g5,7g7,7gb,7gd,7gf,7gh,7gl,7go,7gq,7gt,7gx,7hd,7hh,7hq,7ic,7ie,7ig,7il,7in,7ir,7it,7iz,7jz,7kv,7kx,7l1,7l6,7l9,7ml,7mn,7nh,7nj,7nn,7nx,7oh,7on,7pb,7r0,7rq,7sl,7sv,7vp,7vx,878,87a,8k4,8k9,8kz,8lx,8mx,8nc,8nl,8of,8q6,8ri,8vn,8x1,8yv,8z4,906,90m,90u,912,91a,91i,91q,91y,926,94y,97d,99v,9g5,9h7,9j2,9li,9of,9pp,9se,9tm,9ur,9we,9xj,9xr,a2m,fcv,fen,wi4,wjq,wtn,wzb,x4d,x4n,x7v,x89,x9z,xc4,xcp,xdp,xg3,xh8,xjh,xjt,xku,xme,xn1,xnd,xqa,xrq,xs6,xse,xsm,xt2,xta,xut,xyl,xyx,16lf,16me,16nv,188v,1d6n,1dkv,1dl2,1dlj,1dme,1dmk,1dmp,1dms,1dq9,1e0v,1e33,1e4n,1e65,1e6n,1e6x,1e7j,1e8i,1e92,1e97,1e9g,1ed8,1eg0,1eim,1eiv,1ej3,1ejb,1ejg,1ejq,1ejy,1ekc,1ekr,1eli,1em2,1em5,1eml,1en1,1ere,1erm,1esz,1evg,1evv,1eyl,1f30,1f4g,1f5n,1f6r,1f7u,1f96,1fa5,1fb7,1fbp,1fh9,1fhl,1fl3,1fmr,1fzq,1g0l,1g13,1g5h,1g6t,1g6w,1g7p,1g9q,1ga7,1gc2,1gc5,1gd7,1ge1,1ghj,1gi7,1gjn,1gjq,1gk3,1gk7,1gkz,1gl6,1glj,1gm0,1gnz,1gpy,1gqe,1gs5,1gt1,1gtu,1gup,1gv0,1gvj,1gzs,1h2q,1h4i,1h4v,1hfi,1hsd,1htb,1hvl,1hwo,1hx5,1hys,1hz7,1i0m,1i31,1i3j,1i44,1i4x,1i65,1i86,1i8d,1i8t,1i95,1iay,1ibd,1ibn,1ibw,1ic0,1ico,1icw,1icz,1id5,1idg,1idk,1idp,1ieb,1iek,1ies,1io7,1iop,1iut,1ivx,1iys,1izd,1j1z,1j2h,1j4p,1j57,1j5r,1jhu,1jw8,1lll,1lri,1lro,1lxf,1ovi,1sg6,1zjs,1zku,1zl5,1zlb,1zot,1zp1,1zr9,1zrt,1zs1,1zsn,1ztb,20jo,20la,20m7,2dc1,2fsa,2fss,2ft4,2ftl,2ftv,2jud,2jvq,2k14,2k3p,2kba,2kc1,2kic,2kkc,2kkf,2kkm,2kks,2kl5,2klf,2kn9,2kne,2kno,2knw,2kop,2kou,2kp0,2kpc,2kyt,2l6z,2lqj,2lr3,2lrj,2ojo,2ok6,2pkz,2plr,2plu,2pma,2pmf,2pn3,2pn6,2pnm,2pnu,2po2,2po7,2poc,2pop,2pp7,2ppf,2ppl,2pq3,2prl,2q0b,2q37,2q3y,2q4f,2q4v,2q5x,2q6i,2q6k,2q7h,2q95,2q97,2qai,2qdb,2qde,2qey,2qfc,2qfl,2r21,2r37,2rbk,2rcc,2rcj,2rg3,2ris,2rkb,2rlz,2rmh,2rnr,2rot,2rrs,2rus,47p9,5m9p,jo1r,jobz,mh31,nvnh',
            '05055111110001010110101000010010010101010000001001010000110110010000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000030000000000000000000000000000000000000000000000000000000000000000000000000001101011010000010000000000010001011010010100010100000101010100001010101010100000030001101010101101010101010010100100101000111101010110100010505010000000000000000000000333333333333313303300000000000300000000000000003000130000000000013033300422222420000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000030000000000000000000000000000000000000000000000000000000001011010333300000000000000330111'
        );
        $assoc_values_count = 0;
        $assoc_values = str_split($assoc_values);
        foreach (explode(',', $assoc_keys) as $value) {
            $eaw_table['assoc'][base_convert($value, 36, 10)] = $assoc_values[$assoc_values_count++];
        }
        foreach (explode(',', $range[0]) as $value) {
            $eaw_table['range']['begin'][] = base_convert($value, 36, 10);
        }
        foreach (explode(',', $range[1]) as $value) {
            $eaw_table['range']['end'][] = base_convert($value, 36, 10);
        }
        $eaw_table['range']['name'] = str_split($range[2]);
    }
    $retval = array();
    $ucs = (func_num_args() < 2)
        ? mb_convert_encoding($string, 'UCS-4')
        : mb_convert_encoding($string, 'UCS-4', $encoding);
    foreach (str_split(bin2hex($ucs), 8) as $value) {
        $code = intval($value, 16);
        if (array_key_exists($code, $eaw_table['assoc'])) {
            $retval[] = $eaw_names[$eaw_table['assoc'][$code]];
        } else {
            $index = 0;
            {   // $index = array_upper_bound($eaw_table['range']['begin'], $code) - 1;
                $count = count($eaw_table['range']['begin']);
                while ($count > 0) {
                    $it = $index;
                    $step = floor($count / 2);
                    $it += $step;
                    if (!($code < $eaw_table['range']['begin'][$it])) {
                        $index = ++$it;
                        $count -= $step + 1;
                    } else {
                        $count = $step;
                    }
                }
            }
            --$index;
            if ($code <= $eaw_table['range']['end'][$index]) {
                $retval[] = $eaw_names[$eaw_table['range']['name'][$index]];
            } else {
                trigger_error('Out of UCS-4 range.', E_USER_WARNING);
                return false;
            }
        }
    }
    return $retval;
}
// array mb_east_asian_width_array(string $string, string $encoding = mb_internal_encoding(), array $table = null)
function mb_east_asian_width_array($string, $encoding = null, $table = null)
{
    if (func_num_args() < 3) {
        $table = array('F' => 2, 'H' => 1, 'Na' => 1, 'W' => 2, 'A' => 2, 'N' => 1);
    } else if (is_array($table)) {
        if (!array_key_exists('F', $table) || !array_key_exists('H', $table) ||
            !array_key_exists('Na', $table) || !array_key_exists('W', $table) ||
            !array_key_exists('A', $table) || !array_key_exists('N', $table)
        ) {
            trigger_error("\$table array key must be 'F', 'H', 'Na', 'W', 'A', 'N'.", E_USER_WARNING);
            return false;
        }
    } else {
        trigger_error('Third argument must be Array', E_USER_WARNING);
        return false;
    }
    $names = (func_num_args() < 2)
        ? mb_east_asian_width_names($string)
        : mb_east_asian_width_names($string, $encoding);
    if ($names === false) {
        return false;
    }
    $retval = array();
    foreach ($names as $value) {
        $retval[] = $table[$value];
    }
    return $retval;
}
// int mb_east_asian_width(string $string, string $encoding = mb_internal_encoding(), array $table = null)
function mb_east_asian_width($string, $encoding = null, $table = null)
{
    $eaw_array = ((func_num_args() < 2)
        ? mb_east_asian_width_array($string)
        : ((func_num_args() < 3)
            ? mb_east_asian_width_array($string, $encoding)
            : mb_east_asian_width_array($string, $encoding, $table)
        )
    );
    if ($eaw_array === false) {
        return false;
    }
    return array_sum($eaw_array);
}
